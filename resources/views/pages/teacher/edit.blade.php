@extends("layouts.profile")

<link rel="stylesheet" href="{{ asset("css/forms.css") }}">



@section("title")Редактирование группы @endsection



@section('content')

  @include('pages.teacher.header')

  <div class="limiter table-responsive h-auto">

    <div class="container-login100 container-fluid flex flex-col mb-3">
      <div class="wrap-login100 p-l-15 p-r-55 p-t-25 p-b-50">
        <a href="/profile" class="btn-sm btn-orange"
           style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px"><i class="fa fa-arrow-left"
                                                                                             aria-hidden="true"></i>Назад</a>
        @include('layouts.alerts')
        <form class="login100-form validate-form p-l-25 p-t-45" method="POST">
          @csrf
          <span class="login100-form-title p-b-33">
          Редактирование группы
         </span>
          <small style='font-size:16px'>Название группы:</small>
          <div class='wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='name_group' value='{{ $group_info->name_group }}' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <small style='font-size:16px'>Технология:</small>
          <div class='wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='technology' value='{{ $group_info->technology }}' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>

          <small style='font-size:16px'>Расписание:</small>
          <div class='wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='schedule' value='{{ $group_info->schedule }}' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <small style='font-size:16px'>Год обучения:</small>
          <div class='wrap-input100 rs1 validate-input'>
            <input class='input100' type='text' name='year' value='{{ $group_info->year }}' required>
            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <small style='font-size:16px'>Возраст учеников:</small>
          <div class='wrap-input100 rs1 validate-input'>
            <select class='input100' name='age' required>
              <option value="1" @if ($group_info->age == 1) selected @endif>Подростки</option>
              <option value="2" @if ($group_info->age == 2) selected @endif>Студенты</option>
              <option value="3" @if ($group_info->age == 3)selected @endif>Взрослые</option>
            </select>

            <span class='focus-input100-1'></span>
            <span class='focus-input100-2'></span>
          </div>
          <small style='font-size:16px'>Ученики(выделить тех, кто ушёл):</small>
          <div class="wrap-input100 rs1 validate-input">
            <input type="text" class="input100" id="search" placeholder="Имя ученика">
            <select class="form-control imprt" multiple id="multiple">
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
          <div class='container-login100-form-btn m-t-20'>
            <button type="button" class='login100-form-btn' id="selectAll">
              Выделить всех
            </button>
          </div>
          <div class='container-login100-form-btn m-t-20'>
            <button type="button" class='login100-form-btn' id="deleteAll">
              Снять выделение со всех
            </button>
          </div>
          <script>
            let chosedUsers = {};
            document.querySelector(".imprt").addEventListener("click", e => {
              if (e.target.id !== "searchable") return false;
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
              let options = "";
              Object.keys(chosedUsers).forEach(key => {
                if (key === e.target.value) {
                  delete chosedUsers[key];
                }
              });
              console.log(chosedUsers);
              for (const chosedUsersKey in chosedUsers) {
                options +=
                  `<option value="${chosedUsersKey}" id="sendToServer" selected>${chosedUsers[chosedUsersKey]}</option>`;
              }
              document.querySelector(".checking").innerHTML = options;
              if (Object.keys(chosedUsers).length === 0) {
                document.querySelector(".checking").innerHTML = "";
              }
            })
            document.querySelector("#search").addEventListener("input", e => {
              document.querySelectorAll("#searchable").forEach(element => {
                if (
                  !element.textContent.toLowerCase().includes(e.target.value
                    .toLowerCase())
                ) {
                  element.style = "display:none";
                } else {
                  element.style = "display:block";
                }
              });
            });
            document.querySelector("#selectAll").addEventListener("click", e => {
              e.preventDefault();
              let options = "";
              document.querySelector(".checking").innerHTML = "";
              document.querySelectorAll("#searchable").forEach(elem => {
                elem.selected = true;
                let id = elem.value;
                chosedUsers[elem.value] = elem.innerHTML;
                options += `<option value="${id}" id="sendToServer" selected>${elem.textContent}</option>`;

              })
              document.querySelector('.checking').innerHTML = options;
            })

            document.querySelector('#deleteAll').addEventListener('click', e => {
              e.preventDefault();
              chosedUsers = {};
              document.querySelector('.checking').innerHTML = "";
              document.querySelectorAll('#searchable').forEach(el => el.selected = false)
            })
          </script>
          <div class='container-login100-form-btn m-t-20'>
            <button class='login100-form-btn'>
              Обновить группу
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection