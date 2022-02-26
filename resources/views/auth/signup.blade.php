@extends('layouts.auth')
{{--<link rel="stylesheet" href="{{ asset("public/css/forms.css") }}">--}}
@section('title')
  Регистрация
@endsection

@section('content')

  <style>
      /* 64ac15 */
      *,
      *:before,
      *:after {
          box-sizing: border-box;
      }

      .center {
          display: flex;
          justify-content: center;
      }

      .center h5 {
          color: #747574;
      }

      .center a {
          color: #ffa632;
          text-decoration: none;
      }

      .center a:visited {
          color: #ffa632;
          text-decoration: none;

      }

      .button-submit {
          transition: 1s background ease-out;
          text-align: center;
          background: linear-gradient(
                  180deg, #ffa632 0%, #e8880b 100%);
          color: #fff;
          font-size: 18px;
          border-radius: 5px;
          white-space: nowrap;
          padding: 10px 20px !important;
          transform: translate(0, 5px);
          border: none;
          outline: none;
      }

      .button-submit:hover {
          transition: 1s background ease-out;

          background: linear-gradient(
                  180deg, #f18e0d 0%, #d07807 100%);
          color: #fff;
          font-size: 18px;
          border-radius: 5px;
          white-space: nowrap;
          padding: 10px 20px !important;
          transform: translate(0, 5px);
          border: none;
          outline: none;

      }

      body {
          padding: 1em;
          font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
          font-size: 15px;
          color: #b9b9b9;
          background-color: #e3e3e3;
      }

      h4 {
          color: #f0a500;
      }

      input[type="date"] {
          font-family: "Roboto", sans-serif;
          color: #747574;
          min-width: 4rem ;
          height:3rem;
          line-height: 1.4;
          background-color: #f9f9f9;
          border: 1px solid #e5e5e5;
          border-radius: 3px;
          -webkit-transition: 0.35s ease-in-out;
          -moz-transition: 0.35s ease-in-out;
          -o-transition: 0.35s ease-in-out;
          transition: 0.35s ease-in-out;
          transition: all 0.35s ease-in-out;
      }

      input,
      input[type="radio"] + label,
      input[type="checkbox"] + label:before,
      select option,
      select {
          width: 100%;
          padding: 1em 2em;
          line-height: 1.4;
          background-color: #f9f9f9;
          border: 1px solid #e5e5e5;
          border-radius: 3px;
          -webkit-transition: 0.35s ease-in-out;
          -moz-transition: 0.35s ease-in-out;
          -o-transition: 0.35s ease-in-out;
          transition: 0.35s ease-in-out;
          transition: all 0.35s ease-in-out;
      }

      input:focus {
          outline: 0;
          border-color: #bd8200;
      }

      input:focus + .input-icon i {
          color: #f0a500;
      }

      input:focus + .input-icon:after {
          border-right-color: #f0a500;
      }

      input[type="radio"] {
          display: none;
      }

      input[type="radio"] + label,
      select {
          display: inline-block;
          width: 50%;
          text-align: center;
          float: left;
          border-radius: 0;
      }

      input[type="radio"] + label:first-of-type {
          border-top-left-radius: 3px;
          border-bottom-left-radius: 3px;
      }

      input[type="radio"] + label:last-of-type {
          border-top-right-radius: 3px;
          border-bottom-right-radius: 3px;
      }

      input[type="radio"] + label i {
          padding-right: 0.4em;
      }

      input[type="radio"]:checked + label,
      input:checked + label:before,
      select:focus,
      select:active {
          background-color: #f0a500;
          color: #fff;
          border-color: #bd8200;
      }

      input[type="checkbox"] {
          display: none;
      }

      input[type="checkbox"] + label {
          position: relative;
          display: block;
          padding-left: 1.6em;
      }

      input[type="checkbox"] + label:before {
          position: absolute;
          top: 0.2em;
          left: 0;
          display: block;
          width: 1em;
          height: 1em;
          padding: 0;
          content: "";
      }

      input[type="checkbox"] + label:after {
          position: absolute;
          top: 0.45em;
          left: 0.2em;
          font-size: 0.8em;
          color: #fff;
          opacity: 0;
          font-family: FontAwesome;
          content: "\f00c";
      }

      input:checked + label:after {
          opacity: 1;
      }

      select {
          height: 3.4em;
          line-height: 2;
      }

      select:first-of-type {
          border-top-left-radius: 3px;
          border-bottom-left-radius: 3px;
      }

      select:last-of-type {
          border-top-right-radius: 3px;
          border-bottom-right-radius: 3px;
      }

      select:focus,
      select:active {
          outline: 0;
      }

      select option {
          background-color: #f0a500;
          color: #fff;
      }

      .input-group {
          margin-bottom: 1em;
          zoom: 1;
      }

      .input-group:before,
      .input-group:after {
          content: "";
          display: table;
      }

      .input-group:after {
          clear: both;
      }

      .input-group-icon {
          position: relative;
      }

      .input-group-icon input {
          padding-left: 5em;
      }

      .input-group-icon .input-icon {
          position: absolute;
          top: 0;
          left: 0;
          width: 3.4em;
          height: 3.4em;
          line-height: 3.4em;
          text-align: center;
          pointer-events: none;
      }

      .input-group-icon .input-icon:after {
          position: absolute;
          top: 0.6em;
          bottom: 0.6em;
          left: 3.4em;
          display: block;
          border-right: 1px solid #e5e5e5;
          content: "";
          -webkit-transition: 0.35s ease-in-out;
          -moz-transition: 0.35s ease-in-out;
          -o-transition: 0.35s ease-in-out;
          transition: 0.35s ease-in-out;
          transition: all 0.35s ease-in-out;
      }

      .input-group-icon .input-icon i {
          -webkit-transition: 0.35s ease-in-out;
          -moz-transition: 0.35s ease-in-out;
          -o-transition: 0.35s ease-in-out;
          transition: 0.35s ease-in-out;
          transition: all 0.35s ease-in-out;
      }

      .container {
          max-width: 38em;
          padding: 1em 3em 2em 3em;
          margin: 0em auto;
          background-color: #fff;
          border-radius: 4.2px;
          box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
      }

      .row {
          zoom: 1;
      }

      .row:before,
      .row:after {
          content: "";
          display: table;
      }

      .row:after {
          clear: both;
      }

      .col-half {
          padding-right: 10px;
          float: left;
          width: 50%;
      }

      .col-half:last-of-type {
          padding-right: 0;
      }

      .col-third {
          padding-right: 10px;
          float: left;
          width: 33.33333333%;
      }

      .col-third:last-of-type {
          padding-right: 0;
      }

      @media only screen and (max-width: 540px) {
          .col-half {
              width: 100%;
              padding-right: 0;
          }
      }

  </style>
  <div class="container">
    @include("layouts.alerts")

    <form method="POST" action="{{route("signup")}}">
      @csrf
      <div class="row">
        <h4>Регистрация</h4>
        <div class="input-group input-group-icon"><input name="login" value="{{ old('login') }}" placeholder="Логин"
                                                         required />
          <div class="input-icon"><i class="fa fa-user"></i></div>
        </div>
        <div class="input-group input-group-icon"><input type="password" name="password" placeholder="Пароль"
                                                         required />
          <div class="input-icon"><i class="fa fa-key"></i></div>
        </div>
        <div class="input-group input-group-icon"><input type="password" name="password_confirmation"
                                                         placeholder="Подтверждение пароля" required />
          <div class="input-icon"><i class="fa fa-key"></i></div>
        </div>
        <div class="input-group input-group-icon"><input type="text" name="name" value="{{ old('name') }}"
                                                         placeholder="ФИО" required />
          <div class="input-icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="input-group input-group-icon"><input name="city" value="{{ old('city') }}"
                                                         placeholder="Город проживания" required />
          <div class="input-icon"><i class="fas fa-city"></i></div>
        </div>
        <div class="input-group input-group-icon"><input name="phone_student" value="{{ old('phone_student') }}"
                                                         required
                                                         placeholder="Номер телефона" />
          <div class="input-icon"><i class="fas fa-phone-alt  "></i></div>
        </div>
        <div class="input-group input-group-icon"><input type="date" name="birthday" value="{{ old('birthday') }}"
                                                         placeholder="День рождения" required />
          <div class="input-icon"><i class="fas fa-birthday-cake "></i></div>
        </div>
        <div class="row">
          <div class="col-half">
            <h4>Возраст</h4>
            <div class="input-group">
              <select name="age" required>
                <option value="1">Школьник</option>
                <option value="2">Студент</option>
                <option value="3">Взрослый</option>
              </select>
            </div>
          </div>
          <div class="col-half">
            <h4>Пол</h4>
            <div class="input-group"><input id="gender-male" type="radio" name="sex" value="1" /><label
                for="gender-male">Мужской</label><input id="gender-female" type="radio" name="sex" value="2" /><label
                for="gender-female">Женский</label></div>
          </div>
        </div>
      </div>


      <div class="input-group input-group-icon"><input type="text" name="link_vk" value="{{ old('link_vk') }}"
                                                       required
                                                       placeholder="Cтраница ВК (https://vk.com/id)" />
        <div class="input-icon"><i class="fas fa-link "></i></div>
      </div>
      <div class="input-group input-group-icon"><input type="text" name="name_parent" value="{{ old('name_parent') }}"
                                                       placeholder="ФИО родителя (необязательно)" />
        <div class="input-icon"><i class="fas fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon"><input name="phone_parent" value="{{ old('phone_parent') }}"
                                                       placeholder="Номер телефона родителя (необязательно)" />
        <div class="input-icon"><i class="fas fa-phone-alt  "></i></div>
      </div>
      <div class="input-group input-group-icon"><input type="text" name="parent_vk" value="{{ old('parent_vk') }}"
                                                       placeholder="Cтраница ВК  родителя (https://vk.com/id) (необязательно)" />
        <div class="input-icon"><i class="fas fa-link "></i></div>
      </div>

      <div class="center">
        <button class="button-submit" type="submit">Зарегистрироваться</button>
      </div>
      <div class="center">
        <h5>Уже есть аккаунт? <a href="{{"/login"}}">Авторизация</a></h5>
      </div>
    </form>
  </div>



@endsection

