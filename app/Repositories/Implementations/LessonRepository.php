<?php

namespace App\Repositories\Implementations;

use App\Enums\Beneficiary;
use App\libs\VkBot;
use App\Models\Achievements;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Mark;
use App\Models\Point;
use App\Models\StudentGroups;
use App\Models\User;
use App\Repositories\Interfaces\ILessonRepository;
use Illuminate\Support\Facades\DB;


class LessonRepository implements ILessonRepository
{

    public function __construct ()
    {
        $this->mark = new MarkRepository();
    }

    public function getLessonsDates ($group_id)
    {
        $lessons_duplicated_info = DB::table("student_lessons")
            ->select('date', 'lesson_number')
            ->where('group_id', $group_id)
            ->orderBy('date', 'desc')
            ->get();

        if ( empty($lessons_duplicated_info) ) return [];
        $dates = [];
        $lessons_numbers = [];
        $lessons_info = [];
        foreach ( $lessons_duplicated_info as $item ) {
            if ( !in_array($item->date, $dates) ) {
                $dates[] = $item->date;
                $lessons_numbers[] = $item->lesson_number;
            }
        }
        foreach ( $dates as $i => $v ) {
            $lessons_info[] = [
                'date' => $v,
                'lesson_number' => $lessons_numbers[$i],
            ];
        }
        return $lessons_info;
    }

    public function getLessonInformation ($group_id, $date)
    {
        return DB::table("student_lessons")->select()->where([
            [
                'group_id',
                $group_id,
            ],
            [
                'date',
                $date,
            ],
        ])->first();
    }

    public function addLesson (int $student_id, string $attended_type, $request, $group_id, $lesson_number)
    {
        $this->bot = new VkBot(new UserRepository(), new GroupRepository());
        $lesson_cost = [
            '1' => (int) $request->cost_home,
            '2' => (int) $request->cost_classic,
            '3' => (int) $request->cost_video,
        ];

        $student = StudentGroups::select()->where([
            [
                'student_id',
                $student_id,
            ],
            [
                'group_id',
                $group_id,
            ],
        ])->orderBy('id', 'desc')->first();

        $group_age = Group::where("id", $group_id)->first()->age;
        if ( $group_age !== 3 ) {
            [
                $lesson_balance,
                $cost,
                $array_balance,
            ] = $this->updateBalanceIfSchoolarOrStudent($student, $lesson_cost[$attended_type]);
        } else {
            $student->balance -= $lesson_cost[$attended_type];
        }
        $cost = $lesson_cost[$attended_type];

        Lesson::insert([
            'group_id' => $group_id,
            "date" => $request->date,
            "homework" => $request->homework,
            'lesson_theme' => $request->lesson_theme,
            'balance_lesson' => $lesson_balance,
            'student_id' => $student_id,
            'payment_status' => $attended_type,
            "lesson_cost" => $cost,
            'cost_home' => $request->cost_home,
            'cost_classic' => $request->cost_classic,
            'cost_video' => $request->cost_video,
            'lesson_number' => $lesson_number,
        ]);

        $mark_key = "{$student_id}mark";
        if ( $request->$mark_key != -1 ) {
            Mark::create([
                "mark" => $request->$mark_key,
                "group_id" => $group_id,
                "student_id" => $student_id,
                "created_at" => $request->date,
            ]);
            $sum_marks = Mark::where([
                [
                    "group_id",
                    $group_id,
                ],
                [
                    "student_id",
                    $student_id,
                ],
            ])->sum("mark");
            $last_point_row = Point::where([
                [
                    "student_id",
                    $student_id,
                ],
                [
                    "group_id",
                    $group_id,
                ],
            ])->first();
            if ( $last_point_row == null ) {
                Point::insert([
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                    "value" => $sum_marks,
                ]);
            } else {
                $last_point_row->value += $request->$mark_key;
                $last_point_row->save();
            }
        }
        try {
            $this->giveAchievements(Point::where([
                [
                    "student_id",
                    $student_id,
                ],
                [
                    "group_id",
                    $group_id,
                ],
            ])->first()->value, $student_id, $group_id);
        } catch ( \Exception $e ) {
        }
        $canUserGetMessageFromBot = (new UserRepository())->getUserById($student->student_id)->get_message;

        if ( $canUserGetMessageFromBot )
            $this->bot->notifyAboutLesson($group_id, $request, $student_id, $array_balance, $cost, $attended_type, $lesson_number, $request->$mark_key);
    }

    public function getLessonNumber ($group_id): int
    {
        return DB::table('student_lessons')->select()->where('group_id', $group_id)->orderBy('lesson_number', 'desc')->first() !== null ? DB::table('student_lessons')->select()->where('group_id', $group_id)->orderBy('lesson_number', 'desc')->first()->lesson_number : 0;
    }

    public function editLesson ($information, $group_id, $date)
    {
        foreach ( $information as $key => $field ) {
            if ( is_numeric($key) ) {
                $prices = [
                    '1' => $this->getLessonRow($group_id, $key, $date)->cost_home,
                    '2' => $this->getLessonRow($group_id, $key, $date)->cost_classic,
                    '3' => $this->getLessonRow($group_id, $key, $date)->cost_video,
                ];
                $new_prices = [
                    '1' => (int) $information['cost_home'],
                    '2' => (int) $information['cost_classic'],
                    '3' => (int) $information['cost_video'],
                ];
                $new_mark = $information["mark_{$key}"];
                if ( $new_mark != -1 ) {
                    $mark = Mark::where([
                        [
                            "student_id",
                            $key,
                        ],
                        [
                            "group_id",
                            $group_id,
                        ],
                        [
                            "created_at",
                            $date,
                        ],
                    ])->first();
                    if ( $mark != null )
                        Mark::where([
                            [
                                "student_id",
                                $key,
                            ],
                            [
                                "group_id",
                                $group_id,
                            ],
                            [
                                "created_at",
                                $date,
                            ],
                        ])->update(["mark" => $new_mark]);
                    else
                        Mark::create([
                            "student_id" => $key,
                            "group_id" => $group_id,
                            "created_at" => $date,
                            "mark" => $new_mark,
                        ]);
                }
                $old_payment_status = $this->getLessonRow($group_id, $key, $date)->payment_status;
                if ( $field !== $old_payment_status ) {
                    $difference = $new_prices[$field] - $prices[$old_payment_status];
                    $user = $this->getLessonRow($group_id, $key, $date);
                    $user->homework = $information["homework"];
                    $user->lesson_theme = $information["lesson_theme"];
                    $user->payment_status = $field;
                    $user->lesson_cost = $new_prices[$field];
                    $user->cost_home = $new_prices[1];
                    $user->cost_classic = $new_prices[2];
                    $user->cost_video = $new_prices[3];
                    $user->balance_lesson -= $difference;
                    $user->save();
                    $student_group = StudentGroups::where([
                        [
                            'student_id',
                            $key,
                        ],
                        [
                            'group_id',
                            $group_id,
                        ],
                    ])->first();
                    $student_group->balance -= $difference;
                    $student_group->save();
                }
            }
        }
    }

    private function getLessonRow ($group_id, int $key, $date)
    {

        return Lesson::where([
            [
                'group_id',
                $group_id,
            ],
            [
                'student_id',
                $key,
            ],
            [
                'date',
                $date,
            ],
        ])->first();
    }

    public function getInformationAboutStudentsOnLesson ($group_id, $date)
    {
        $payments = DB::table("student_lessons")->select('student_id', 'payment_status')->where([
            [
                'group_id',
                $group_id,
            ],
            [
                'date',
                $date,
            ],
        ])->get();
        $students = [];
        foreach ( $payments as $item ) {
            $mark = Mark::where([
                [
                    "student_id",
                    $item->student_id,
                ],
                [
                    "group_id",
                    $group_id,
                ],
                [
                    "created_at",
                    $date,
                ],
            ])
                ->first();
            $students[] = [
                'name' => User::find($item->student_id)->name,
                'payment_status' => $item->payment_status,
                'id' => $item->student_id,
                "mark" => $mark ? $mark->mark : null,
            ];
        }
        return $students;
    }

    public function getStudentAmountByPaymentStatusInTeacherGroups ($teacher_id, string $start, string $end, int $payment_status)
    {
        return count(DB::select("SELECT `id` FROM student_lessons WHERE payment_status = ? AND group_id IN (SELECT id FROM `groups` WHERE teacher_id = ?) AND date >= ? AND date <= ?", [
            $payment_status,
            $teacher_id,
            $start . " 00:00:00",
            $end . " 23:59:59",
        ]));
    }

    public function getStudentAmountInTeacherGroups ($teacher_id)
    {
        return count(DB::select("SELECT `id` FROM student_groups WHERE group_id IN (SELECT id FROM `groups` WHERE teacher_id = ?)", [
            $teacher_id,
        ]));
    }

    public function getStudentsByPaymentsStatusOnLesson ($group, array $week, $payment_status): int
    {
        return DB::table("student_lessons")->where([
            [
                "group_id",
                $group->id,
            ],
            [
                "date",
                ">=",
                $week["start"] . " 00:00:00",
            ],
            [
                "date",
                "<=",
                $week["end"] . " 23:59:00",
            ],
            [
                "payment_status",
                $payment_status,
            ],
        ])->count();
    }

    public function giveAchievements (int $points, int $student_id, $group_id)
    {
        /*
            * beginner 0
            успешный старт
            ещё чуть-чуть
            junior 150
            успешный старт
            ещё чуть-чуть
            middle 350
            senior 600
            team lead 900
            1000 макс
            */
        if ( $points >= 0 && $points < 75 ) {
            $achive = Achievements::where([
                "name" => "Урааа вы Beginner!!!",
                "student_id" => $student_id,
                "group_id" => $group_id,
            ])->first();
            if ( $achive == null )
                Achievements::insert([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
        }
        if ( $points >= 75 && $points < 150 ) {

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            $achive = Achievements::where([
                "name" => "Урааа вы Beginner+ !!!",
                "student_id" => $student_id,
                "group_id" => $group_id,
            ])->first();
            if ( $achive == null )
                Achievements::insert([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
        }
        if ( $points >= 150 && $points < 250 ) {

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {

                Achievements::insert([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            $achive = Achievements::where([
                "name" => "Урааа вы Junior!!!",
                "student_id" => $student_id,

                "group_id" => $group_id,
            ])->first();
            if ( $achive == null )
                Achievements::insert([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
        }
        if ( $points >= 250 && $points < 350 ) {
            if ( Achievements::where([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {

                Achievements::insert([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,

                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            $achive = Achievements::where([
                "name" => "Урааа вы Junior +!!!",
                "student_id" => $student_id,
                "group_id" => $group_id,
            ])->first();
            if ( $achive == null )
                Achievements::insert([
                    "name" => "Урааа вы Junior +!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
        }

        if ( $points >= 350 && $points < 475 ) {

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {

                Achievements::insert([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,

                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Junior +!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Junior +!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            $achive = Achievements::where([
                "name" => "Урааа вы Middle!!!",
                "student_id" => $student_id,
                "group_id" => $group_id,
            ])->first();
            if ( $achive == null )
                Achievements::insert([
                    "name" => "Урааа вы Middle!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
        }
        if ( $points >= 475 && $points < 600 ) {

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {

                Achievements::insert([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Junior +!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Junior +!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Middle!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Middle!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            $achive = Achievements::where([
                "name" => "Урааа вы Middle+ !!!",
                "student_id" => $student_id,
                "group_id" => $group_id,
            ])->first();

            if ( $achive == null )
                Achievements::insert([
                    "name" => "Урааа вы Middle+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
        }

        if ( $points >= 600 && $points < 750 ) {

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {

                Achievements::insert([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,

                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Junior +!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Junior +!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Middle!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Middle!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Middle+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Middle+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            $achive = Achievements::where([
                "name" => "Урааа вы Senior!!!",
                "student_id" => $student_id,
                "group_id" => $group_id,
            ])->first();
            if ( $achive == null )
                Achievements::insert([
                    "name" => "Урааа вы Senior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
        }
        if ( $points >= 750 && $points < 900 ) {

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {

                Achievements::insert([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,

                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Junior +!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Junior +!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Middle!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Middle!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Middle+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Middle+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Senior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {

                Achievements::insert([
                    "name" => "Урааа вы Senior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            $achive = Achievements::where([
                "name" => "Урааа вы Senior+!!!",
                "student_id" => $student_id,
                "group_id" => $group_id,
            ])->first();
            if ( $achive == null )
                Achievements::insert([
                    "name" => "Урааа вы Senior+!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
        }
        if ( $points >= 900 && $points < 1000 ) {

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Beginner!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {

                Achievements::insert([
                    "name" => "Урааа вы Beginner+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            if ( Achievements::where([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,

                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Junior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Junior +!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Junior +!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Middle!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Middle!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Middle+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Middle+ !!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Senior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {

                Achievements::insert([
                    "name" => "Урааа вы Senior!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }


            if ( Achievements::where([
                    "name" => "Урааа вы Senior+!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ])->first() == null ) {
                Achievements::insert([
                    "name" => "Урааа вы Senior+!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
            }

            $achive = Achievements::where([
                "name" => "Урааа вы Team Lead!!!",
                "student_id" => $student_id,
                "group_id" => $group_id,
            ])->first();
            if ( $achive == null )
                Achievements::insert([
                    "name" => "Урааа вы Team Lead!!!",
                    "student_id" => $student_id,
                    "group_id" => $group_id,
                ]);
        }
    }

    private function updateBalanceIfSchoolarOrStudent ($student, $lesson_cost)
    {
        $balance = $student->balance;
        $bonuses = $student->count_bonus_lessons;
        if ( $student->balance < $lesson_cost && $student->count_bonus_lessons != 0 ) {
            //$student->count_bonus_lessons -= ;
            if ( $balance <= 0 ) {
                if ( $lesson_cost > $bonuses ) {
                    $rest_payment = $lesson_cost - $bonuses;
                    $student->count_bonus_lessons = 0;
                    $student->balance -= $rest_payment;
                } else {
                    $student->count_bonus_lessons -= $lesson_cost;
                }
                $student->save();
            }
            if ( $balance > 0 ) {
                $rest_payment = $lesson_cost - abs(0 - $balance);
                $not_enoughed_money = 0;
                if ( $student->count_bonus_lessons < $rest_payment ) {
                    $not_enoughed_money = $rest_payment - $student->count_bonus_lessons;
                    $student->balance = -$not_enoughed_money;
                    $student->count_bonus_lessons = 0;
                } else {
                    $student->count_bonus_lessons -= $rest_payment;
                    $student->balance = 0;
                }
                $student->save();
            }
        } else {
            if ( $student->exempt )
                $student->balance = $student->balance - Beneficiary::Percent * $lesson_cost;
            else
                $student->balance = $student->balance - $lesson_cost;
        }
        $lesson_balance = $balance;
        $cost = $balance - $student->balance;
        if ( $cost == 0 ) {
            $cost = $lesson_cost;
        }
        $array_balance = [
            "old" => $balance,
            "new" => $student->balance,
        ];

        $student->save();
        return [
            $lesson_balance,
            $cost,
            $array_balance,
        ];
    }

}
