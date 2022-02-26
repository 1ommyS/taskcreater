@extends('layouts.profile')

<link rel="stylesheet" href="{{ asset("css/forms.css") }}">

@section('title') Редактирование пользователя @endsection

@section('content')
  @include('pages.admin.header')

  <div class="limiter table-responsive ">
    <div class="container-login100 container-fluid h-full">
      <div class="wrap-login100 p-l-15 p-r-55 p-t-25 p-b-50">
        <form class="login100-form validate-form p-l-55 p-r-45 p-t-45" method="POST">
          @csrf
          @include('layouts.alerts')
          <span class="login100-form-title p-b-33">
         Редактирование
       </span>
          <small style='font-size:16px; color:#666'>Имя:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='name' value="{{ $user->name }}" placeholder='Имя'
                   required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>

          <small style='font-size:16px; color:#666'>Пароль:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='password' placeholder='Пароль' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <small style='font-size:16px; color:#666'>E-mail:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='email' name='email' value="{{ $user->email }}" placeholder='E-mail' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <div class='container-login100-form-btn m-t-20'>
            <button class='login100-form-btn'>
              Сменить Данные
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection