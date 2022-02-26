@extends('layouts.auth')
@section('title')
  Авторизация
@endsection
@section('content')
  <style>
      .alert-danger {
          color: red !important;
      }

      /* 64ac15 */
      *,
      *:before,
      *:after {
          box-sizing: border-box;
      }

      .center {
          display: flex;
          justify-content: center;
          flex-direction: column;
      }

      .other h5 {
          color: #747574;
      }

      .other a {
          color: #ffa632;
          text-decoration: none;
      }

      .other a:visited {
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

      .button-back {
          transition: 1s background ease-out;
          text-align: center;
          background: linear-gradient(
                  180deg, #ffa632 0%, #e8880b 100%);
          color: #fff;
          font-size: 13px;
          border-radius: 5px;
          white-space: nowrap;
          text-decoration: none;
          padding: 10px 10px !important;
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

      a {
          cursor: pointer;
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
    <form method="POST" action="{{route("login")}}">
      <a href="/" class="button-back"><i class="fas fa-arrow-left"></i>  Вернуться назад </a>
      @csrf
      <div class="row">
        <h4>Авторизация</h4>
          @include("layouts.alerts")

          <div class="input-group input-group-icon"><input name="email" id="login" value="{{ old('login') }}"
                                                         placeholder="e-mail"
                                                         required />
          <div class="input-icon"><i class="fa fa-user"></i></div>
        </div>
        <div class="input-group input-group-icon"><input type="password" name="password" placeholder="Пароль"
                                                         required />
          <div class="input-icon"><i class="fa fa-key"></i></div>
        </div>
      </div>
      <div class="center">
        <button class="button-submit" type="submit">Авторизация</button>
      </div>
      <div class="other">
        <h5>Еще нет аккаунта? <a href="{{"/signup"}}">Зарегистрироваться</a></h5>
        <h5>Забыли пароль? <a id="restorepass">Восстановить</a></h5>
      </div>

      <div class="center">
      </div>
    </form>
  </div>
  <script>
    document.querySelector("#restorepass").addEventListener("click", e => {
      e.preventDefault();
      const login = document.getElementById("login").value;
      console.log(login);
      let confirmation = confirm(`Вы точно хотите сбросить пароль? Новый пароль будет выслан в ВК, привязанный к аккаунту с логином ${login}`)
      if (confirmation) {
        fetch("/restorepassword", {
            method: "post",
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              login: login
            })
          }
        )
      }
    })
  </script>


@endsection

