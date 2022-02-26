@extends("layouts.profile")

@section("title") Редактировании урока @endsection



@section('content')

  <link rel="stylesheet" href="{{ asset("css/forms.css") }}">

  @include('pages.teacher.header')

  <div class="container">
    <div class="mt-2">
      <a href="/group/{{$group_id}}"  class="btn-sm btn-orange"
         style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px; cursor:pointer"><i class="fa fa-arrow-left"
                                                                                           aria-hidden="true"></i>
        Назад</a>
    </div>
    <div class="jumbotron jumbotron-fluid mt-2">

      <h1 class="display-4 text-center mt-2">Редактирование занятия</h1>
    </div>


    <form class="form" method="POST"
          style="padding:30px; border:1px solid #ccc; border-radius:7px">
      @csrf
      <div class="form-group">
        <label for="datelesson">Дата занятия: {{ date("d.m.Y",strtotime($lesson_info->date))}}</label>
      </div>
      @include('layouts.alerts')

      <div class="form-group">
        <label for="hw">Домашняя работа</label>
        <textarea class="form-control" id="hw" rows="3" placeholder="Посмотреть видео"
                  name="homework">{{$lesson_info->homework}}</textarea>
      </div>
      <div class="form-group">
        <label for="theme">Тема урока</label>
        <input class="form-control" id="theme" placeholder="Типы данных в языке программирования" name="lesson_theme"
               value="{{$lesson_info->lesson_theme}}">
      </div>
      <small>Стоимость занятия с ДЗ (необязательно)</small>
      <div class="wrap-input100 rs1 validate-input">
        <input class="input100" type="number" id="costHome"
               placeholder="Стоимость занятия с ДЗ (необязательно)" name="cost_home"
               value="{{$lesson_info->cost_home}}">
        <span class="focus-input100-1"></span>
        <span class="focus-input100-2"></span>
      </div>
      <small>Стоимость занятия без ДЗ (необязательно)</small>
      <div class="wrap-input100 rs1 validate-input">
        <input class="input100" type="number" id="costClassic"
               placeholder="Стоимость занятия без ДЗ (необязательно)" name="cost_classic"
               value={{$lesson_info->cost_classic}}>
        <span class="focus-input100-1"></span>
        <span class="focus-input100-2"></span>
     </div>
      <small>Стоимость видео (необязательно)</small>
      <div class="wrap-input100 rs1 validate-input">
        <input class="input100" type="number" id="costVideo" placeholder="Стоимость видео (необязательно)"
               value={{$lesson_info->cost_video}}
               name="cost_video">
        <span class="focus-input100-1"></span>
        <span class="focus-input100-2"></span>
      </div>
      <table class="table">
        <thead>
        <tr>
          <th scope="col">Имя ученика</th>
          <th scope="col">Присутствие на уроке</th>
          <th scope="col">Активность на уроке</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
          <tr>
            <td>{{$student['name']}}</td>
            <td>
              <select name="{{$student['id']}}" class="form-control">
                <option @if ($student['payment_status'] == "1")
                        selected
                        @endif
                        value="1">
                  Выполняет ДЗ
                </option>
                <option @if ( $student['payment_status']  == "2" )
                        selected
                        @endif value="2">
                  Не
                  Выполняет ДЗ
                </option>
                <option @if ($student['payment_status'] == "3" )
                        selected
                        @endif
                        value="3">
                  Смотрит Видео
                </option>
              </select>
            </td>
            <td><input type="number" class="form-control" name="mark_{{$student['id']}}" value="{{$student["mark"] ?? -1}}"></td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="form-group">
        <button class="btn btn-orange" type="submit">Сохранить Изменения</button>
      </div>
    </form>
  </div>
@endsection