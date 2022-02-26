<?php

use App\Http\Controllers\{
    MigrateTable,
    RoleController,
    Roles\AdminController,
    Roles\StudentController,
    UserController
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name("login")->middleware('guest');
Route::get('/signup', function () {
    return view('auth.signup');
})->name("signup")->middleware('guest');

Route::post('/', [
    UserController::class,
    "auth",
])->name('auth.login');
Route::post('/signup', [
    UserController::class,
    "create",
])->name('auth.create');
Route::get('/logout', [
    UserController::class,
    "logout",
]);
Route::view('/profile/review-create', 'powergrid-demo');
Route::group(['middleware' => 'authenticated'], function () {

});

Route::group(["prefix" => "/profile"], function () {
    Route::match([
        'get',
        'post',
    ], '/', [
        RoleController::class,
        "defineRole",
    ])->name('profile')->middleware('authenticated');
    Route::get('/settings', [
        RoleController::class,
        "settingsPage",
    ])->name('profile.update')->middleware('authenticated');
    Route::post('/settings', [
        RoleController::class,
        "store",
    ])->name('profile.save')->middleware('authenticated');

    // store payment

    // main section
    Route::group(['middleware' => 'is_student'], function () {
    });
    Route::group(['middleware' => 'is_teacher'], function () {

    });
    Route::group(['middleware' => 'is_admin'], function () {

        Route::get('/students', [
            AdminController::class,
            "students",
        ])->name("admin.struct.students");
    });
});
Route::controller(AdminController::class)->group(function () {
    Route::get("/profile/teachers", "teachersView");
    Route::get("edit/{id}", "editView");
    Route::get("delete/{id}", "deleteRow");
});
Route::post("edit/{id}", [AdminController::class, "saveEditedRow"]);
Route::controller(\App\Http\Controllers\Roles\TeacherController::class)->group(function () {
    Route::post('/profile', "createGroup");
    Route::get("/profile/mygroups", "groupsList");
    Route::get("profile/addStudent/{id}", "addStudentToGroupView")->name("teacher.group.new.student");
    Route::post("profile/addStudent/{id}", "saveNewStudentInGroup");
});

Route::controller(\App\Http\Controllers\LabsController::class)->group(function () {
    Route::get("/labs/create/{id}", "createLabView")->name("teacher.labs.create");
    Route::post("/labs/create/{id}", "save");
    Route::get("/tasks/view/{id}", "viewTasks")->name("teacher.labs.tasks");
    Route::get("/labs/{id}", "getLabsInGroup")->name("teacher.labs.list");
    Route::get("/labs/{id}/marks", "viewMarks")->name("teacher.labs.marks");
    Route::get("/tasks/{id}", "viewLabs");
    Route::get("/tasks/solve/{id}", "completeLab");
    Route::post("/tasks/solve/{id}", "checkAnswers");
    Route::get("/labs/preview_variants/{id}/{amount}", "previewVariants")->name("preview_variants");
    Route::post("/labs/preview_variants/{id}/{amount}", "chooseVariant");

});
Route::fallback(function () {
    abort('404');
});
