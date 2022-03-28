@extends('layouts.profile')

<link rel="stylesheet" href="{{ asset("css/forms.css") }}">

@section('title') Создать группу

@endsection

@section('content')
  @include('pages.teacher.header')

  <div class="limiter table-responsive">
    <div class="container-fluid container-login100 flex flex-col">
      <div class="wrap-login100 p-l-15 p-r-55 p-t-25 p-b-50">

        <form class="login100-form validate-form p-l-25 p-t-45" method="POST">
          @csrf
          @include('layouts.alerts')
          <span class="login100-form-title p-b-33">
          Создание группы
        </span>
          <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="name" placeholder="Название группы" required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>

          <div class="wrap-input100 rs1 validate-input">
            <input class="input100" type="number" name="step" placeholder="Курс" min="1" required>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>

          <div class="wrap-input100 rs1 validate-input">
            Информация о курсе
            <hr>
            <textarea rows="8" class="input100" name="information" required></textarea>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>

          <div class="wrap-input100 rs1 validate-input">
            Контактные данные
            <hr>
            <textarea rows="8" class="input100" name="data_to_connect" required></textarea>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>

          <small style='font-size:16px'>Выбор учеников в группу(множественный выбор):</small>
          <div class="wrap-input100 rs1 validate-input">
            <input type="text" class="input100" id="search" placeholder="Имя ученика">
            <select class="form-control imprt" multiple id="multiple" required>
              @foreach ( $students as $student )
                <option id='searchable' class='checked' value={{$student->id}}>{{$student->name}}</option>
              @endforeach
            </select>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>
          <br>
          <small style='font-size:16px'>Выбранные ученики:</small>
          <div class="wrap-input100 rs1 validate-input">
            <select class="form-control checking" multiple id="multiple" name="users[]">
            </select>
            <span class="focus-input100-1"></span>
            <span class="focus-input100-2"></span>
          </div>
          <br>
          <script>
            let chosedUsers = {};
            document.querySelector(".imprt").addEventListener("click", e => {
              if (e.target.id !== "searchable") return;
              chosedUsers[e.target.value] = e.target.textContent;
              let options = "";
              for (const chosedUsersKey in chosedUsers) {
                options +=
                  `<option value="${chosedUsersKey}" id="sendToServer" selected>${chosedUsers[chosedUsersKey]}</option>`;
                document.querySelector(".checking").innerHTML = options;
              }
            })
            document.querySelector(".checking").addEventListener("click", e => {
              let elementsNodeList = document.querySelectorAll("#sendToServer");
              let elements = [];
              elementsNodeList.forEach((el, index) => {
                if (el.innerHTML !== e.target.innerHTML) {
                  elements.push(el.outerHTML);
                }
              })
              let options = "";
              for (const user of elements) {
                options += `${user}`;
                document.querySelector(".checking").innerHTML = options;
              }
            })
          </script>
          <div class="container-login100-form-btn m-t-20">
            <button class="login100-form-btn">
              Создать группу
            </button>
          </div>
          <script>
            document.querySelector("#search").addEventListener("input", (e) => {
              document.querySelectorAll("#searchable").forEach((element) => {
                if (!element.textContent.toLowerCase().includes(e.target.value
                  .toLowerCase())
                ) {
                  element.style = "display:none";
                } else {
                  element.style = "display:block";
                }
              });
            });
          </script>
        </form>
      </div>
    </div>
  </div>
@endsection