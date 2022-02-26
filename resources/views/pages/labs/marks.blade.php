@extends('layouts.profile')

@section('title')Лабораторные работы @endsection


@section('content')
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
  <link rel="stylesheet" href="{{ asset('css/utils.css') }}">

  @include('pages.teacher.header')

  <div class="container mt-2 table-responsive" style="padding:10px">
    @include('layouts.alerts')
    <table id="selectedColumn" class="table table-hover table-striped table-bordered table-sm" cellspacing="0"
           style="border:1px solid #ccc;border-radius:10px !important;padding: 7px">
      <thead class="table-dark">
      <tr>
        <th scope="col" style="border-right: 2px solid #eee;font-weight:bold !important;">Имя студента</th>
        <th>Оценка</th>
      </tr>
      </thead>
      <tbody>
      @foreach($marks as $name => $mark)
        <tr>
          <td>{{ $name}}</td>
          <td>
            {{ $mark }}
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection

