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
  @include('pages.teacher.header')
  <div class="container mt-2 table-responsive" style="padding:10px">
    @include('layouts.alerts')
    @foreach ($tasks as $task)
      <div class="cards">
        <div class="card border p-3">
          <div class="card-body">
            {{ $task->question }}
          </div>
          <div class="alert alert-success" role="alert">
            Ответ: {{ $task->answer }}
          </div>
          <hr>
        </div>
      </div>
    @endforeach

  </div>
@endsection

