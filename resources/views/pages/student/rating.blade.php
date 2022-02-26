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
            <a class="nav-link active" href="/profile/rating" aria-current="page">Рейтинг всех учеников</a>
          </li>

         @if (Auth::user()->role_id == 2)
         <li class="nav-item">
            <a class="nav-link" href="/profile/wages" aria-current="page">Зарплата</a>
          </li>
         @endif
         
          <li class="nav-item">
            <a class="nav-link" href="/profile/settings">Персональные данные</a>
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

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
          integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
          crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css" />
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

  <div class="container table-responsive">
    <table data-page-length='100' id="myTable"
           class="table table-hover border table-striped table-bordered table-sm">
      <thead class="table-dark">
      <tr>
        <th data-id="1">Номер</th>
        <th scope="col" data-id="2">Имя ученика</th>
        <th scope="col" data-id="8">Статус</th>
        <th scope="col" data-id="5">Год обучения</th>
        <th scope="col" data-id="4">Группа</th>
        <th scope="col" data-id="6">Имя учителя</th>
        <th scope="col" data-id="8">Количество набранных баллов</th>
      </tr>
      </thead>
      <tbody>
      @foreach($points as $point)
      @if ($point)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{  $point ? $point->name : "" }}</td>
          <td>{{  $point ? $point->status : "" }}</td>
          <td>{{  $point ? $point->year : "" }}</td>
          <td>{{  $point ? $point->name_group : "" }}</td>
          <td>{{  $point ? $point->teacher_name : "" }}</td>
          <td>{{  $point ? $point->value : "" }}</td>
        </tr>
        @endif
      @endforeach
      </tbody>
    </table>
  </div>
@endsection