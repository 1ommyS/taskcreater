@extends('layouts.profile')

@section('title')Лабораторные работы @endsection


@section('content')
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
  <link rel="stylesheet" href="{{ asset('css/utils.css') }}">

  @include('pages.teacher.header')

  <div class="container mt-2 table-responsive" style="padding:10px">
    @include('layouts.alerts')
    <div class="mb-3">
      <h2>Лабораторные работы</h2>
      <a href="{{ route("teacher.labs.create", $id) }}" class="btn btn-sm btn-primary">Создать лабораторную</a>
    </div>
    <table id="selectedColumn" class="table table-hover table-striped table-bordered table-sm" cellspacing="0"
           style="border:1px solid #ccc;border-radius:10px !important;padding: 7px">
      <thead class="table-dark">
      <tr>
        <th scope="col" style="border-right: 2px solid #eee;font-weight:bold !important;">Название</th>
        <th>Посмотреть задания</th>
        <th>Посмотреть оценки студентов</th>
      </tr>
      </thead>
      <tbody>
      @foreach($labs as $lab)
        @if ($lab->lab_name != "")
          <tr>
            <td>{{ $lab->lab_name }}</td>
            <td>
              <a href="{{ route("teacher.labs.tasks", $lab->id) }}" class="btn btn-sm btn-info">Посмотреть задания</a>
            </td>
            <td>
              <a href="{{ route("teacher.labs.marks", $lab->id) }}" class="btn btn-sm btn-warning">Посмотреть</a>
            </td>
          </tr>
        @endif
      @endforeach
      </tbody>
    </table>
  </div>
@endsection

