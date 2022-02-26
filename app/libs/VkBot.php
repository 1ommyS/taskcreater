<?php


namespace App\libs;

use App\Models\Group;
use App\Models\Log;
use App\Models\StudentGroups;
use App\Models\User;
use App\Repositories\Implementations\GroupRepository;
use App\Repositories\Implementations\UserRepository;
use App\utils\FormatUtils;
use Exception;
use Illuminate\Support\Facades\DB;

class VkBot
{
    private UserRepository $userRepository;
    private GroupRepository $groupRepository;
    private string $token = 'a043a862cd2ffaacdd4bc3beedff34ab783292ad179c82c90e53a20fdb6c0c50a5a4ee5c43dd0c4f52dd5';
    private string $directorId = "325516589";
    private string $managerId = "191371532";

    public function __construct (UserRepository $userRepository, GroupRepository $groupRepository)
    {
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
    }

    public function sendNotificationAboutSmallMoneyAmount ($group_id)
    {
        $userIds = StudentGroups::where([
            [
                "balance",
                "<",
                "0"
            ],
            [
                "group_id",
                $group_id
            ]
        ])->get();
        foreach ( $userIds as $id ) {
            try {

                $vkLink = User::where('id', $id->student_id)->first()->link_vk;
                $vkLink = explode("/", $vkLink);
                $vkLink = $vkLink[count($vkLink) - 1];
                $group_name = str_replace("#", "%23", str_replace(" ", "%20", $this->groupRepository->getGroupName($group_id)));
                $teacher_name = str_replace(" ", "%20", User::where("id", Group::where("id", $group_id)->first()->teacher_id)->first()->name);

                $message = "Привет,%20у%20тебя%20на%20счету%20отрицательный%20баланс%0AЗадолжность:{$id->balance}руб.%0AГруппа:%20{$group_name}.%0AИмя%20учителя:%20{$teacher_name}%20!%0A%20Пополни%20его,%20пожалуйста,%20как%20можно%20скорее%20=)";
                $userId = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$vkLink}&access_token={$this->token}&v=5.103"));
                $userId = $userId->response[0]->id;
                $maxId = DB::table("unique_message_ids")->count('id');

                $res = json_decode(file_get_contents("https://api.vk.com/method/messages.send?user_id={$userId}&random_id={$maxId}&peer_id=-58525095&message={$message}&access_token={$this->token}&v=5.103"));
                DB::table('unique_message_ids')->insert(['content' => "___"]);

            } catch ( Exception $e ) {
            }
        }
    }

    public function notifyAboutLesson ($group_id, $lesson, $student_id, $balance, $lesson_cost, $attended_type, $lesson_id, $mark)
    {
        try {
            $student = $this->userRepository->getUserById($student_id);
            $attended_types = [
                '1' => "Выполнял%20домашнее%20задание",
                '2' => "Не%20выполнял%20домашнее%20задание",
                '3' => "Смотрел%20видео",
            ];
            $student_name = explode(" ", $student->name)[1];
            $group_name = str_replace("#", "%23", str_replace(" ", "%20", $this->groupRepository->getGroupName($group_id)));
            $lesson_theme = str_replace(" ", "%20", $lesson->lesson_theme);
            $homework = str_replace(" ", "%20", $lesson->homework);
            $link_vk = $student->link_vk;
            $link_vk = explode("/", $link_vk);
            $link_vk = $link_vk[count($link_vk) - 1];
            $msg_with_mark = "Рейтинг%20учеников:%20itpark32.ru/profile/rating%0AТвой%20рейтинг:%20itpark32.ru/profile/marks/{$group_id}";
            $message = "Привет,%20{$student_name},%20ты%20посетил%20занятие%20в%20группе:%20{$group_name}!%0AФормат%20посещения:%20{$attended_types[$attended_type]}.%0AСтоимость%20занятия:%20{$lesson_cost}%20руб.%0AТвой%20баланс%20перед%20уроком:%20{$balance['old']}.%0AТвой%20новый%20баланс:%20{$balance['new']}.%0AТема%20урока:{$lesson_theme}.%0AДомашняя%20работа:%20{$homework}%0A{$msg_with_mark}";

            if ($mark != -1) {
                $message .="%0AАктивность%20на%20уроке:%20{$mark}.%0A";
            }
            $message.= "%0AСпасибо%20за%20посещение%20занятия!%20Удачи%20в%20саморазвитии%20и%20хорошего%20настроения";
            $userId = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$link_vk}&access_token={$this->token}&v=5.103"));
            $userId = $userId->response[0]->id;
            $maxId = DB::table("unique_message_ids")->count('id');
            $res = json_decode(file_get_contents("https://api.vk.com/method/messages.send?user_id={$userId}&random_id={$maxId}&peer_id=-58525095&message={$message}&access_token={$this->token}&v=5.103"));
            DB::table('unique_message_ids')->insert(['content' => "___"]);
            Log::create([
                "user_id" => $student_id,
                "message" => "Списание средств",
                "group_id" => $group_id,
                "vk" => $student->link_vk,
                "balance_before_transaction" => $balance['old'],
                "balance_after_transaction" => $balance['new'],
                "lesson_cost" => $lesson_cost,
                "lesson_number" => $lesson_id,
                "type" => 1,
                "status" => 1
            ]);
        } catch ( Exception $e ) {
            try {
                Log::create([
                    "user_id" => $student_id,
                    "message" => "Списание средств",
                    "group_id" => $group_id,
                    "vk" => $student->link_vk,
                    "balance_before_transaction" => $balance['old'],
                    "balance_after_transaction" => $balance['new'],
                    "lesson_cost" => $lesson_cost,
                    "lesson_number" => $lesson_id,
                    "type" => 1,
                    "status" => 0
                ]);
            } catch ( Exception $e ) {
            }
        }
    }

    /**
     * @param string $group
     * @param string $teacherName
     * @param string $studentName
     * @param string $date - from date('Y-m-d H:i:s')
     * @param int $payment_amount
     * @param int $lessons_count
     * @param int $bonus_counts
     * @param int $balance
     */
    public function notifyDirectorAboutPayment (string $group, string $teacherName, string $studentName, string $date, int $payment_amount, int $lessons_count,int  $bonus_counts, int $balance)
    {
        try {
            [
                $group,
                $student_info,
                $teacherName,
                $date
            ] = $this->prepareInformationForRequest($group, $studentName, $teacherName, $date);
            $message = "Привет,%0A{$student_info}%20пополнил%20баланс%20на%20{$payment_amount}%20рублей%20.%0AГруппа:{$group}.%0AУчитель:{$teacherName}.%0AДата:{$date}.%0AКоличество%20бонусов:{$bonus_counts}.%0AБаланс:{$balance}";
            $maxId = DB::table('unique_message_ids')->count('id');
            $res = json_decode(file_get_contents("https://api.vk.com/method/messages.send?user_id=325516589&random_id={$maxId}&peer_id=-58525095&message={$message}&access_token={$this->token}&v=5.103"));
            DB::table('unique_message_ids')->insert(['content' => "___"]);

        } catch ( Exception $e ) {
        }
    }

    public function notifyStudentAboutPayment (string $group, $teacher, $name_student, $date, $payment_amount, $lessons_count, $bonus_counts, $balance)
    {
        [
            $group,
            $student_info,
            $teacher,
            $date
        ] = $this->prepareInformationForRequest($group, $name_student, $teacher, $date);
        try {
            $message = "Привет,%0A{$student_info}.Ты%20пополнил%20баланс%20на%20{$payment_amount}%20рублей%20.%0A%20Группа:{$group}.%0AУчитель:{$teacher}.%0AДата:{$date}.%0AКоличество%20бонусов:{$bonus_counts}.%0AСтарый%20баланс:{$balance['old']}%0AТекущий%20баланс:{$balance['new']}";

            $link_vk = (new UserRepository())->getUserVKByName($student_info);

            $link_vk = explode("/", $link_vk);

            $link_vk = $link_vk[count($link_vk) - 1];

            $maxId = DB::table('unique_message_ids')->count('id');

            $userId = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$link_vk}&access_token={$this->token}&v=5.103"));

            $userId = $userId->response[0]->id;

            $res = json_decode(file_get_contents("https://api.vk.com/method/messages.send?user_id={$userId}&random_id={$maxId}&peer_id=-58525095&message={$message}&access_token={$this->token}&v=5.103"));

            DB::table('unique_message_ids')->insert(['content' => "___"]);

            Log::create([
                'user_id' => User::where("name", FormatUtils::UrlDecode($student_info))->first()->id,
                "message" => "Пополнение счета",
                "group_id" => Group::where("name_group", FormatUtils::UrlDecode($group))->first()->id,
                "vk" => $link_vk,
                "balance_before_transaction" => $balance['old'],
                "balance_after_transaction" => $balance['new'],
                "lesson_cost" => "0",
                "lesson_number" => 0,
                "type" => 0,
                "status" => 1
            ]);

        } catch ( Exception $e ) {
            Log::create([
                'user_id' => User::where("name", FormatUtils::UrlDecode($student_info))->first()->id,
                "message" => $e->getMessage() . " " . $e->getLine() . " " . $e->getTraceAsString(),
                "group_id" => Group::where("name_group", FormatUtils::UrlDecode($group))->first()->id,
                "vk" => $link_vk,
                "balance_before_transaction" => $balance['old'],
                "balance_after_transaction" => $balance['new'],
                "lesson_cost" => "0",
                "lesson_number" => 0,
                "type" => 0,
                "status" => 0
            ]);
        }


    }

    public function sendMessageToAll (string $message, $users)
    {
        $students_success = [];
        $students_failed = [];
        foreach ( $users as $u ) {
            try {
                $usersLinks = User::where('id', $u)->first();
                $user = explode("/", $usersLinks->link_vk);
                $user = $user[count($user) - 1];
                $message = str_replace(" ", "%20", $message);
                $userId = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user}&access_token={$this->token}&v=5.103"));
                $userId = $userId->response[0]->id;
                $maxId = DB::table("unique_message_ids")->count('id');
                $res = json_decode(file_get_contents("https://api.vk.com/method/messages.send?user_id={$userId}&random_id={$maxId}&peer_id=-58525095&message={$message}&access_token={$this->token}&v=5.103"));
                DB::table('unique_message_ids')->insert(['content' => "___"]);
                if ( isset($res->error) && $res->error->error_code == 901 ) {
                    $students_failed[] = $usersLinks->name;
                } else {
                    $students_success[] = $usersLinks->name;
                }
            } catch ( Exception $e ) {

            }
        }
        return [
            'success' => $students_success,
            'failed' => $students_failed
        ];
    }

    public function notifyAboutBirthdayInThreeDays ($in_three_days_users)
    {
        try {
            foreach ( $in_three_days_users as $user ) {
                $archive = DB::select("SELECT archive FROM `groups` WHERE id IN (SELECT group_id FROM student_groups WHERE student_id = ?)", [$user->id])[0]->archive;
                if ($archive == 1)
                    break;

                $user_name = str_replace(" ", "%20", $user->name);
                $groups = DB::select("SELECT name_group, teacher_id FROM `groups` WHERE id IN (SELECT group_id FROM student_groups WHERE student_id = ?)", [$user->id]);
                $groups_and_teachers = [];
                if ( empty($groups) ) return;
                foreach ( $groups as $group ) {
                    $teacher_name = User::where("id", $group->teacher_id)->first()->name;
                    $groups_and_teachers[$teacher_name] = $group->name_group;
                }
                $ages = [
                    1 => "Школьник",
                    2 => "Студент",
                    3 => "Взрослый"
                ];
                $groups_info_prepared_for_request = "";
                foreach ( $groups_and_teachers as $teacher_name => $group_name ) {
                    $prepared_group_name = FormatUtils::UrlEncode($group_name);
                    $prepared_teacher_name = FormatUtils::UrlEncode($teacher_name);
                    $groups_info_prepared_for_request .= "Группа:%20\"{$prepared_group_name}\",%20Учитель:%20{$prepared_teacher_name}.%0A";
                }
                $birthday_date = date("d.m.Y", strtotime($user->birthday));
                $message = "Привет,%0Aу%20{$user_name}%20через%20три%20дня%20день%20рождение.%0AДата:%20{$birthday_date}.%0AВК:%20{$user->link_vk}%0A{$groups_info_prepared_for_request}%0AВозрастная%20категория:%20{$ages[$user->age]}";
                $maxId = DB::table('unique_message_ids')->count('id');
                json_decode(file_get_contents("https://api.vk.com/method/messages.send?user_id=325516589&random_id={$maxId}&peer_id=-58525095&message={$message}&access_token={$this->token}&v=5.103"));
                DB::table('unique_message_ids')->insert(['content' => "___"]);
            }
            DB::table('unique_message_ids')->insert(['content' => "___"]);
        } catch ( Exception $e ) {
        }
    }

    public function notifyAboutBirthdayToday ($today_users)
    {
        try {
            foreach ( $today_users as $user ) {

                $archive = DB::select("SELECT archive FROM `groups` WHERE id IN (SELECT group_id FROM student_groups WHERE student_id = ?)", [$user->id])[0]->archive;
                if ($archive == 1)
                    break;

                $user_name = str_replace(" ", "%20", $user->name);
                $groups = DB::select("SELECT name_group, teacher_id FROM `groups` WHERE id IN (SELECT group_id FROM student_groups WHERE student_id = ?)", [$user->id]);
                $groups_and_teachers = [];
                if ( empty($groups) ) return;

                foreach ( $groups as $group ) {
                    $teacher_name = User::where("id", $group->teacher_id)->first()->name;
                    $groups_and_teachers[$teacher_name] = $group->name_group;
                }
                $ages = [
                    1 => "Школьник",
                    2 => "Студент",
                    3 => "Взрослый"
                ];
                $groups_info_prepared_for_request = "";
                foreach ( $groups_and_teachers as $teacher_name => $group_name ) {
                    $prepared_group_name = FormatUtils::UrlEncode($group_name);
                    $prepared_teacher_name = FormatUtils::UrlEncode($teacher_name);
                    $groups_info_prepared_for_request .= "Группа:%20\"{$prepared_group_name}\",%20Учитель:%20{$prepared_teacher_name}.%0A";
                }
                $birthday_date = date("d.m.Y", strtotime($user->birthday));
                $message = "Привет,%0Aу%20{$user_name}%20сегодня%20день%20рождение.%0AДата:%20{$birthday_date}.%0AВК:%20{$user->link_vk}%0A{$groups_info_prepared_for_request}%0AВозрастная%20категория:%20{$ages[$user->age]}";

                $maxId = DB::table('unique_message_ids')->count('id');
             json_decode(file_get_contents("https://api.vk.com/method/messages.send?user_id=" . $this->directorId . "&random_id={$maxId}&peer_id=-58525095&message={$message}&access_token={$this->token}&v=5.103"));
                DB::table('unique_message_ids')->insert(['content' => "___"]);
                $maxId = DB::table('unique_message_ids')->count('id');
                json_decode(file_get_contents("https://api.vk.com/method/messages.send?user_id=" . $this->managerId . "&random_id={$maxId}&peer_id=-58525095&message={$message}&access_token={$this->token}&v=5.103"));
                DB::table('unique_message_ids')->insert(['content' => "___"]);
            }
        } catch ( Exception $e ) {

        }
    }

    private function prepareInformationForRequest (string $group, $name_student, $teacher, $date): array
    {

        $group = str_replace(" ", "%20", $group);


        $group = str_replace("#", "%23", $group);


        $student_info = str_replace(" ", "%20", $name_student);


        $teacher = str_replace(" ", "%20", $teacher);


        $date = str_replace(" ", "%20", $date);

        return [
            $group,
            $student_info,
            $teacher,
            $date
        ];

    }

    public function sendNewPassword ( $vk, $password)
    {
        $vk = $vk;
        $vk = explode("/", $vk);
        $vk = $vk[count($vk) - 1];

        $message= "Привет!%20Твой%20новый%20пароль:%20{$password}";
        $userId = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$vk}&access_token={$this->token}&v=5.103"));
        $userId = $userId->response[0]->id;
        $maxId = DB::table("unique_message_ids")->count('id');
        $res = json_decode(file_get_contents("https://api.vk.com/method/messages.send?user_id={$userId}&random_id={$maxId}&peer_id=-58525095&message={$message}&access_token={$this->token}&v=5.103"));
        DB::table('unique_message_ids')->insert(['content' => "___"]);

        $admin_vk = User::where("id", 1)->first()->link_vk;

        $userId = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$admin_vk}&access_token={$this->token}&v=5.103"));
        $userId = $userId->response[0]->id;
        $maxId = DB::table("unique_message_ids")->count('id');

        $message="Пользователь%20{$vk}поменял%20пароль.%20Новый%20пароль:{$password}";
        $res = json_decode(file_get_contents("https://api.vk.com/method/messages.send?user_id={$userId}&random_id={$maxId}&peer_id=-58525095&message={$message}&access_token={$this->token}&v=5.103"));
        DB::table('unique_message_ids')->insert(['content' => "___"]);
    }


}