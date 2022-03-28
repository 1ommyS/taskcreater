@extends('layouts.profile')

@section('title')Лабораторные работы @endsection


@section('content')
  <style>
      .card {
          margin-bottom: 2rem;
      }
  </style>
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
    <h1>{{ $lab->lab_name }}</h1>
    @if (isset($mark))
      <div class="alert alert-danger" role="alert">
        <h1>
          Ваша оценка: {{ $mark }}
        </h1>
      </div>

    @endif
    <form class="form text-center border p-2" method="post">
      @csrf
      @foreach ($tasks as $k=>$task)

        <div class="cards">
          <div class="card border p-3">
            <div class="card-body">
              {{$task->question }}
            </div>
            @if (!isset($checked_answers))
              <input type="text" name="{{$task->id}}" class="form-control" placeholder="Ваш ответ...">
            @else
              Ваш ответ - {{ $checked_answers[$k]->user_answer }} - {{ $checked_answers[$k]->is_correct ? "":"не" }}правильный
            @endif
            <hr>
          </div>
        </div>
      @endforeach
      @if (! isset($checked_answers))

        <button type="submit" class="btn btn-success">Сдать работу</button>
      @endif
    </form>
  </div>
@endsection

