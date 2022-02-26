@extends("layouts.profile")
@section("title") Добавить ученика @endsection
@section('content')
  <link rel="stylesheet" href="{{ asset("css/forms.css") }}">
  @include('pages.teacher.header')
  <div class="limiter table-responsive h-100">
    <div class="container-fluid h-100 container-login100 flex flex-col left-0 float-left flex-col-l">
      <div class="wrap-login100 p-l-15 p-r-55 p-t-25 p-b-50">
        <a href="/profile" class="btn-sm btn-orange"
           style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px"><i class="fa fa-arrow-left"
                                                                                             aria-hidden="true"></i>
          Назад</a>
        <form class="login100-form validate-form  p-l-25 p-t-45" method="POST">
          @csrf
          @include('layouts.alerts')
          <span class="login100-form-title p-b-33">
           Добавление ученика
         </span>
          <div class="wrap-input100 validate-input mb-2">
            <input type="text" class="input100" placeholder="Имя ученика..." id="input">
          </div>
          <div class="wrap-input100 validate-input">
            <select name="logins[]" multiple class="form-control" id="students">
              @foreach($users as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
              @endforeach
            </select>
          </div>
          <script>
            document.querySelector("#input").addEventListener("input", (e) => {
              document.querySelectorAll("option").forEach((element) => {
                if (
                  !element.textContent.toLowerCase().includes(e.target.value.toLowerCase())
                ) {
                  element.style = "display:none";
                } else {
                  element.style = "display:block";
                }
              });
            });
          </script>
          <div class="container-login100-form-btn m-t-20">
            <button class="login100-form-btn">
              <input type="hidden" name="group_id">
              Добавить
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection