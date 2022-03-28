@extends('layouts.profile')

@section('title')Лабораторные работы @endsection


@section('content')
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
  <link rel="stylesheet" href="{{ asset('css/utils.css') }}">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <span class="navbar-brand">С возвращением, <br> {{ Auth::user()->name }} </span>
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
            <a href="/" class="nav-link">Главная страница</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout" tabindex="-1">Выйти из аккаунта</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-2 table-responsive" style="padding:10px">
    @include('layouts.alerts')
    <h2>Мои лабораторные работы</h2>
    <table id="selectedColumn" class="table table-hover table-striped table-bordered table-sm" cellspacing="0"
           style="border:1px solid #ccc;border-radius:10px !important;padding: 7px">
      <thead class="table-dark">
      <tr>
        <th scope="col" style="border-right: 2px solid #eee;font-weight:bold !important;">Название</th>
        <th>Перейти к выполнению</th>
        <th>Оценка</th>
      </tr>
      </thead>
      <tbody>
      @foreach($labs as $lab)
        @if ($lab->lab_name != "")
          <tr>
            <td>{{ $lab->lab_name }}</td>
            <td>
              <a href="/tasks/solve/{{ $lab->id }}" class="btn btn-sm btn-danger">
                @if (!in_array($lab->id, $completed_labs))
                  Перейти к выполнению
                @else
                  Пересдать
                @endif
              </a>
            </td>
            <td>
              @if (empty($marks[$lab->id]))
                Не выполняли работу
              @else
                @foreach($marks[$lab->id] as $m)
                  @if ($loop->last)
                    {{$m->mark}}.
                  @else
                    {{$m->mark}},
                  @endif
                @endforeach
              @endif
            </td>
          </tr>
        @endif
      @endforeach
      </tbody>
    </table>
  </div>
@endsection

