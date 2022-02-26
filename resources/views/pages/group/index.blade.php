@extends("layouts.profile")

@section("title") Группа | {{ $title }} @endsection

@section('content')
  <style>
      .wrapper {
          white-space: nowrap
      }

      .jumbotron {
          padding: 2rem 1rem !important;
      }

      body {
          font-size: 12px !important;
      }

  </style>

  @if (Auth::user()->role_id === 2)
    @include('pages.teacher.header')
  @endif

  <div class="container-fluid jumbotron mt-4">
    <h2 class="display-4 text-center mt-2">Группа: {{ $title }}</h2>
    <p class="lead text-center"></p>
    @include('layouts.alerts')
  </div>
  <div class="table-responsive m-2">
    <div>
      <div class="col-sm-3" style="display:inline-block;">
        <h1
          style="padding-bottom:10px; border-bottom:4px solid #FF8F88; font-size: 15px !important;width: 20rem !important;">
          Баланс < 500 рублей</h1>
      </div>
      <div class="col-sm-3" style="display:inline-block;">
        <h1
          style="padding-bottom:10px; border-bottom:4px solid  #FFD37F; font-size: 15px !important; width: 20rem !important;">
          Баланс >= 550 рублей и <= 1650</h1>
      </div>
      <div class="col-sm-3" style="display:inline-block;">
        <h1
          style="padding-bottom:10px; border-bottom:4px solid #9CE1C6; font-size: 15px !important;width: 20rem !important;">
          Баланс > 1650 рублей</h1>
      </div>
    </div>

    <div class="mb-2">
      <div class="col-sm-3" style="display:inline-block;">
        <svg enable-background="new 0 0 32 32" height="32px" id="svg2" version="1.1" viewBox="0 0 32 32" width="32px"
             xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
         <g id="background">
           <rect fill="none" height="32" width="32" x="1" y="1" />
         </g>
          <g id="book_x5F_sans">
            <g>
              <path
                d="M27.002,1v1.999h-2V5h2v28h-24c0,0-2,0-2-2V4.018c0-0.006-0.001-0.012-0.001-0.018C0.966,2.645,1.808,1.686,2.556,1.354    C3.294,0.992,3.918,1.004,4.002,1H27.002 M3.998,5C4,5,4.002,5,4.002,5h19V2.999h-19C4,3.005,3.97,2.997,3.853,3.018    c-0.115,0.019-0.274,0.06-0.404,0.125C3.196,3.314,3.035,3.353,3.002,4c0.015,0.5,0.134,0.609,0.272,0.743    c0.144,0.126,0.401,0.212,0.579,0.239C3.948,4.999,3.986,5,3.998,5 M5.002,31h20V7h-20V31" />
            </g>
          </g>
       </svg>
        Выполнял ДЗ
      </div>
      <div class="col-sm-3" style="display:inline-block;">
        <svg enable-background="new 0 0 32 32" height="32px" id="svg2" version="1.1" viewBox="0 0 32 32" width="32px"
             xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
         <g id="background">
           <rect fill="none" height="32" width="32" />
         </g>
          <g id="book_x5F_sans_x5F_remove">
            <g>
              <g>
                <path
                  d="M32,23.001c0-3.917-2.506-7.239-5.998-8.478V4h-2V1.999h2V0h-23C2.918,0.004,2.294-0.008,1.556,0.354     C0.808,0.686-0.034,1.645,0.001,3c0,0.006,0.001,0.012,0.001,0.018V30c0,2,2,2,2,2h21.081l-0.007-0.004     C28.013,31.955,32,27.946,32,23.001z M2.853,3.981C2.675,3.955,2.418,3.869,2.274,3.743C2.136,3.609,2.017,3.5,2.002,3     c0.033-0.646,0.194-0.686,0.447-0.856c0.13-0.065,0.289-0.107,0.404-0.125C2.97,1.997,3,2.005,3.002,1.999h19V4h-19     C3,4,2.97,4.002,2.853,3.981z M4.002,30V6h20v8.06C23.673,14.023,23.339,14,23,14c-4.972,0-9,4.029-9,9.001     c0,2.829,1.307,5.35,3.348,6.999H4.002z M23,30c-3.865-0.008-6.994-3.135-7-6.999c0.006-3.865,3.135-6.995,7-7.001     c3.865,0.006,6.992,3.136,7,7.001C29.992,26.865,26.865,29.992,23,30z" />
              </g>
            </g>
            <g>
              <rect height="2" width="10" x="18" y="22" />
            </g>
          </g>
       </svg>
        Не Выполнял ДЗ
      </div>
      <div class="col-sm-3" style="display:inline-block;">
        <svg enable-background="new 0 0 24 24" height="24px" id="Layer_1" version="1.1" viewBox="0 0 24 24" width="24px"
             xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
         <path clip-rule="evenodd"
               d="M22.506,21v0.016L17,15.511V19c0,1.105-0.896,2-2,2h-1.5H3H2c-1.104,0-2-0.895-2-2  v-1l0,0V6l0,0V5c0-1.104,0.896-1.999,2-1.999h1l0,0h10.5l0,0H15c1.104,0,2,0.895,2,1.999v3.516l5.5-5.5V3.001  c0.828,0,1.5,0.671,1.5,1.499v15C24,20.327,23.331,20.996,22.506,21z"
               fill-rule="evenodd" />
       </svg>
        Смотрел видео
      </div>
    </div>
  </div>
  <div class="wrapper container-fluid table-responsive">
    <table class="table table-striped table-hover">
      @if(!$is_archive)
        @if(Auth::user()->role_id === 2)
          <a href="/group/addlesson/{{$group_id}}" class="btn btn-orange m-2" style="color:white">Добавить урок</a>
        @else
          <a href="/profile/groups" class="btn btn-orange"
             style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px"> <i class="fa fa-arrow-left"
                                                                                                aria-hidden="true"></i>
            К списку групп</a>
        @endif
            <a href="/profile/marks/{{$group_id}}" class="btn btn-orange m-2" style="color:white">Просмотреть активность учеников</a>
        @endif

      <thead class="table-dark">
      <th>Посещаемость</th>
      @empty($format_dates)<h1>Уроков ещё не было</h1>@endempty
      @foreach ($format_dates as $date)
        <th>
          <a href='/group/lesson/{{$group_id}}/{{$date['date']}}'
             style='color:white;text-decoration: underline'>У₽ № {{ $date['lesson_number'] }}
            <br>{{ date("d.m.Y",strtotime($date['date'])) }} - {{ $date['day_week'] }} </a>
        </th>
      @endforeach
      </thead>

      <tbody>

      @foreach($students_with_payments as $student)
        <tr class="table-light">
          <td>
            <a href='/profile/student/{{$student['id']}}/{{$group_id}}'
               style='color:black;font-weight: bold;font-weight:bold !important;text-decoration: underline;'>
              {{$student['name']}} ({{$student['balance']}}₽ + {{$student['bonuses']}} ₽)</a></td>
          @foreach($student['payments'] as $i => $payment)
            <td
              style='background: {{ isset($student['color'][$i]) ? $student['color'][$i] : "#FF8F88" }};border:1px solid #ccc;font-weight:bold;'> {!!  $payments[$payment->payment_status]!!}
              ({{$payment->lesson_cost}} ₽)
            </td>
          @endforeach
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection

