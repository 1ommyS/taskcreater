@extends('layouts.profile')

@section('title')Мои ученики

@endsection



@section('content')
  @include('pages.teacher.header')

  <div class="container">
    <div class="mt-2">
     <h1>
        <a onclick="history.back()" class="btn-sm btn-orange"
           style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px">  <i class="fa fa-arrow-left" aria-hidden="true"></i>
         Назад</a>
      </h1>
   </div>
   <table class="table table-striped table-bordered table-hover border-2 rounded">
      <thead class="thead-dark">
     <th>Ученики</th>
      </thead>
      <tbody>
      @foreach ( $students as $student )
        <tr>
          <td>
            <a href='/profile/student/{{$student['student']->id}}/{{$id}}'
               style='color:black;font-weight:bold !important;text-decoration: underline;'>{{ $student['student']->name }}
              ({{ $student['balance'] }}р. +{{ $student['bonus_lessons'] }}
             бонусов)</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection
