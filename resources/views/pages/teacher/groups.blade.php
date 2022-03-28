@extends('layouts.profile')

@section('title') Мои группы

@endsection

<link rel="stylesheet" href="{{ asset("css/forms.css") }}">

@section('content')
  @include('pages.teacher.header')

  <div class="container mt-3 table-responsive">
    <h1 class="text-center mb-2 ">Активные группы</h1>
    <a class="btn btn-orange float-left mb-2" style="color:white" href="/profile/addgroup">Создать группу</a>
  </div>
  <div class="container mt-3 table-responsive">
    @include('layouts.alerts')

    <table class="table table-hover mb-2 table-striped table-bordered text-center">
      <thead class="table-dark">
      <tr>
        <th>Название группы</th>
        <th>Курс обучения</th>
        <th>Информация о курсе</th>
        <th>Контактные данные</th>
        <th>Добавление Студентов</th>
        <th>Лабораторные работы</th>
        <th>Исключить из группы</th>
      </tr>
      </thead>
      <tbody>
      @foreach ( $groups as $group )
        <tr>
          <td>
            {{$group -> title}}
          </td>
          <td style='font-size:16px;'>
            {{$group -> step}}
          </td>
          <td>
            {{ $group->information }}
          </td>
          <td>
            {{ $group->contact_data }}
          </td>

          <td>
            <a class="btn btn-sm btn-outline-primary" href="{{ route("teacher.group.new.student", $group->id) }}">Добавить
                                                                                                                  студента</a>
          </td>
          <td>
            <a class="btn btn-sm btn-outline-success" href="{{ route("teacher.labs.list", $group->id) }}">Лабораторные
                                                                                                          работы</a>
          </td>  <td>
            <a class="btn btn-sm btn-outline-danger" href="{{ route("teacher.group.kickStudent", $group->id) }}">Исключить студента</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <style>
        .table > :not(caption) > * > * {
            padding: 1rem 1rem !important;
        }
    </style>
    <br />
    @if (empty($groups) && empty($archived_groups))
      <h1>У вас ещё нет групп</h1>
    @endif
  </div>
  <script>
    document.querySelectorAll('button[data-id]').forEach(element => {
      element.addEventListener('click', event => {
        $.ajax({

          method: "POST",

          url: "/profile/addstudent",

          data: {

            "login": document.querySelector(`input[data-value="${element.dataset.id}"]`)

              .value,

            "group_id": element.dataset.id,

            "price": document.querySelector(
              `input[data-value="${element.dataset.id}price"]`).value

          }

        }).done(msg => console.log(msg))
      })
    })
  </script>
@endsection