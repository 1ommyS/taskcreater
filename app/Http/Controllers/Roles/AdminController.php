<?php

namespace App\Http\Controllers\Roles;

use App\Enums\Roles;
use App\Enums\Types;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherSaveRequest;
use App\libs\{Sms, VkBot};
use App\Models\{Admin, Kicked, Percent, Post, Premium, Salary, User, Wages};
use App\Repositories\Implementations\{GroupRepository, LogRepository, TransactionsRepository, UserRepository};
use App\Services\Implementations\{AnalyticService, RequestValidationService, SalaryService, UserService};
use App\utils\{DateUtils};
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, DB, Validator};

class AdminController extends Controller
{
    public function show (Request $request)
    {
        $users = User::where("role_id", 1)->get();
        return view("pages.admin.students", compact("users"));
    }
public function teachersView (Request $request)
    {
        $users = User::where("role_id", 2)->get();
        return view("pages.admin.teachers", compact("users"));
    }

    public function editView (Request $request, int $id)
    {
        $user = User::findOrFail($id);
        return view("pages.admin.edit", compact("user"));
    }

    public function deleteRow (Request $request, int $id)
    {
        User::find($id)->delete();
        session()->flash("success", "Пользователь удален");
        return redirect("/profile");

    }

    public function saveEditedRow (Request $request, int $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->password = hash("sha3-256", $request->password);
        $user->email = $request->email;
        $user->save();
        session()->flash("success", "Данные успешно обновлены");
        return redirect("/profile");
    }
}
