<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\libs\Sberbank;
use App\Models\{CompletedTasks, Group, StudentGroups};
use App\Repositories\Implementations\{StudentRepository};
use App\Services\Implementations\{NotificationService, TaskService};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Validator};


class StudentController extends Controller
{

    /**
     * @param \App\Services\Implementations\TaskService $service
     */
    public function __construct (private TaskService $service, private NotificationService $notificationService) { }

    public function show ()
    {
        $groups = Group::query()->join("student_groups", "student_groups.group_id", "=", "groups.id")->where("student_groups.student_id", Auth::id())->get();
        return view("pages.student.index", compact("groups"));
    }

    public function settingsPage (Request $request)
    {
        return view('pages.student.settings');
    }


    public function store (Request $request)
    {
        $rules = [
            'login' => 'required  ',
            'password' => 'required',
            'name' => 'required',
            'city' => 'required',
            'phone_student' => 'required',
            'phone_parent' => 'required',
            'birthday' => 'required',
            "parent_vk" => "required",
            'age' => 'required',
            'link_vk' => 'required',
            'name_parent' => 'required',
        ];
        $messages = [
            'name.required' => 'Укажите своё имя',
            'password.required' => 'Укажите свой пароль',
            'login.required' => 'Укажите свой логин',
            'city.required' => 'Укажите город своего проживания',
            'phone_student.required' => 'Укажите свой телефон',
            'phone_parent.required' => 'Укажите телефон своего родителя',
            'birthday.required' => 'Укажите дату своего рождения',
            'link_vk.required' => 'Укажите свой VK',
            'name_parent.required' => 'Укажите имя своего родителя',
            'age.required' => 'Укажите свой возраст',
            "parent_vk.required" => "Укажите ВК родителя",
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();
        $this->repo->saveStudent(Auth::id(), $request);

        session()->flash('success', 'Вы успешно обновили свои данные');
        return redirect()->back();

    }

    public function getTasksForSolving (int $count)
    {
        $tasks = $this->service->getTasks($count);
        return view("pages.student.tasks", compact("tasks"));
    }

    public function solveTasks (int $group, Request $request)
    {
        for ( $i = 0; $i < count($request->tasks); $i++ ) {
            CompletedTasks::query()->create(
                [
                    "user_id" => Auth::id(),
                    "group_id" => $group,
                    "task_id" => $request->input("task_number{$i}"),
                    "user_answer" => $request->input("answer_umber{$i}"),
                ]
            );
        }
        $this->notificationService->notifyTeacherAboutSolvedTasks(student_id: Auth::id(), group_id: $group);

    }
}