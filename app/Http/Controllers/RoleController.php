<?php


namespace App\Http\Controllers;


use App\Enums\Roles;
use App\Http\Controllers\Roles\AdminController;
use App\Http\Controllers\Roles\StudentController;
use App\Http\Controllers\Roles\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    private StudentController $studentController;
    private TeacherController $teacherController;
    private AdminController $adminController;
    private array $roles_controllers;


    public function __construct (StudentController $studentController, TeacherController $teacherController, AdminController $adminController,)
    {
        $this->studentController = $studentController;
        $this->teacherController = $teacherController;
        $this->adminController = $adminController;

        $this->roles_controllers = [
            1 => $this->studentController,
            2 => $this->teacherController,
            3 => $this->adminController,
        ];

    }


    public function defineRole (Request $request)
    {
        return $this->roles_controllers[Auth::user()->role_id]->show($request);
    }


    public function settingsPage (Request $request)
    {
        return $this->roles_controllers[Auth::user()->role_id]->settingsPage($request);
    }


    public function store (Request $request)
    {
        return $this->roles_controllers[Auth::user()->role_id]->store($request);
    }
}