<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Notification;
use App\Models\StudentGroups;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function __construct (private Teacher $model) { }

    public function notifications ()
    {
        $group_ids = Group::query()->where("teacher_id", Auth::id())->get();
        $notifications = [];
        foreach ( $group_ids as $groupId ) {
            $notifications[] = Notification::query()->where([["group_id", $groupId], ["readed", 0]])->get();
            Notification::query()->where("group_id", $groupId)->update(["readed" => 1]);
        }
        return $notifications;
    }

    public function show ()
    {

        $students = User::query()->where("role_id", 1)->get();
        return view("pages.teacher.newgroup", compact("students"));
    }

    public function createGroup (Request $request)
    {
        $this->model->createGroup($request, Auth::user());
        session()->flash("success", "Группа успешно создана");
        return redirect()->back();
    }

    public function groupsList ()
    {
        $groups = Group::all();
        return view("pages.teacher.groups", compact("groups"));
    }

    public function addStudentToGroupView (int $id)
    {
        $users = User::query()->where("role_id", 1)->get();
        return view("pages.teacher.addstudent", compact("users"));
    }

    public function kickStudentFromGroupView (int $id)
    {
        $ids_object = StudentGroups::query()->where("group_id", $id)->get("student_id");
        $ids = [];
        foreach ( $ids_object as $item ) {
            $ids[] = $item->student_id;
        }
        $users = User::query()->whereIn("id", $ids)->get();
        return view("pages.teacher.kickStudent", compact("users"));
    }

    public function saveNewStudentInGroup (Request $request, int $id)
    {
        foreach ( $request->logins as $student_id ) {
            StudentGroups::query()->create(["group_id" => $id, "student_id" => $student_id]);
        }
        return redirect("/profile/mygroups");

    }

    public function kickStudentFromGroup (Request $request, int $id)
    {
        foreach ( $request->logins as $student_id ) {
            StudentGroups::query()->where([["group_id", $id], ["student_id", $student_id]])->delete();
        }
        return redirect("/profile/mygroups");
    }
}
