@extends('layouts.profile')

<link rel="stylesheet" href="{{ asset("css/forms.css") }}">



@section('title') Настройки @endsection



@section('content')
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <span class="navbar-brand">С возвращением, <br> {{ Auth::user()->login }} </span>
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " href="/profile/" aria-current="page">Мои группы</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/profile/rating">Рейтинг всех учеников</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/profile/settings">Персональные данные</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://vk.com/1ommy" tabindex="-1" target="_blank">Сообщить о проблеме
                                                                                          разработчику</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout" tabindex="-1">Выйти из аккаунта</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="limiter table-responsive">
    <div class="container-login100 container-fluid">
      <div class="wrap-login100 p-l-15 p-r-55 p-t-25 p-b-50">
        <a href=" {{ route('profile') }}" class="btn-sm m-3 btn-orange"
           style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px"> <i class="fa fa-arrow-left"
                                                                                              aria-hidden="true"></i>
          Назад</a>
        <form class="login100-form validate-form p-l-55 p-r-45 p-t-45" method="POST"
              action="{{ route('profile.save') }}">
          @csrf
          @include('layouts.alerts')
          <span class="login100-form-title p-b-33">
         Персональные данные
       </span>
          <small style='font-size:16px; color:#666'>Логин:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='login' value="{{ Auth::user()->login }}" placeholder='login'
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
          <small style='font-size:16px; color:#666'>Имя:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='name' value="{{ Auth::user()->name }}" placeholder='имя' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>

          <small style='font-size:16px; color:#666'>Город проживания:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='city' value="{{ Auth::user()->city }}"
                   placeholder='Город проживания' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <small style='font-size:16px; color:#666'>Номер телефона:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='phone_student' value="{{ Auth::user()->phone_student }}"
                   placeholder='Номер телефона' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>

          <small style='font-size:16px; color:#666'>Имя родителя:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='name_parent' value="{{ Auth::user()->name_parent }}"
                   placeholder='Номер родителя' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>

          <small style='font-size:16px; color:#666'>Номер родителя:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='phone_parent' value="{{ Auth::user()->phone_parent }}"
                   placeholder='Номер родителя' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <small style='font-size:16px; color:#666'>ВК родителя:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='parent_vk' value="{{ Auth::user()->parent_vk }}"
                   placeholder='ВК родителя' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <small style='font-size:16px; color:#666'>Страница ВК:</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='link_vk' value="{{ Auth::user()->link_vk }}"
                   placeholder='Страница ВК' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <small style='font-size:16px; color:#666'>День рождения</small>
          <div class='mt-1 mb-2 wrap-input100 rs1 validate-input'>
            <input class='input100' type='date' name='birthday'
                   value={{ Auth::user()->birthday }} required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <small style='font-size:16px; color:#666'>Возраст:</small>
          <div class='wrap-input100 rs1 validate-input mt-2'>
            <select name='age' class='form-control'>
              <option value='1' {{ Auth::user()->age == \App\Enums\Ages::SCHOLAR ? "selected" : ""}} id='val_0'>Школьник</option>
              <option value='2' {{ Auth::user()->age == \App\Enums\Ages::STUDENT ? "selected" : ""}}   id='val_1'>Студент</option>
              <option value='3' {{ Auth::user()->age == \App\Enums\Ages::ADULT ? "selected" : ""}}  id='val_2'>Взрослый</option>
            </select>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <small style='font-size:16px; color:#666'>Пол:</small>
          <div class='wrap-input100 rs1 validate-input mt-2'>
            <select name='sex' class='form-control'>
              <option value='1' @if(Auth::user()->sex == 1) selected @endif>Мужской</option>
              <option value='2' @if(Auth::user()->sex == 2) selected @endif >Женский</option>
            </select>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <div class='wrap-input100 rs1 validate-input mt-2'
               style="align-items: center; display: flex; flex-direction: row">
            <label for="message">Получать сообщения от бота о посещении занятия</label>
            <input id="message" type="checkbox" class="input_checkbox" name="get_message"
                   {{ Auth::user() ->get_message == 1 ? "checked" : ""}} style="width: 25px;height: 25px; margin: 5px;">
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