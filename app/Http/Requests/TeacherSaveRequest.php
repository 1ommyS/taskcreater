<?php

namespace App\Http\Requests;

use App\Enums\Roles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TeacherSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        return [
            "login" => ["required", "unique:users"],
            "name" => ["required"],
            "password" => ["required"],
        ];
    }
    public function messages ()
    {
        return [
            "login.required" => "Логин - обязательное поле",
            "name.required" => "Имя - обязательное поле",
            "password.required" => "Пароль - обязательное поле",
            "login.unique" => "Пользователь с таким логином существует",
        ];
    }
}
