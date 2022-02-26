@extends('layouts.profile')



@section('title') История посещений @endsection


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
          <a class="nav-link" href="/profile/" aria-current="page">Мои группы</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/profile/rating">Рейтинг всех учеников</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/profile/settings">Персональные данные</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="https://vk.com/1ommy" tabindex="-1" target="_blank">Сообщить о проблеме разработчику</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout" tabindex="-1">Выйти из аккаунта</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-2">

  <a onclick="history.back()" class="btn-sm btn-warning"
     style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px"> <i class="fa fa-arrow-left"      aria-hidden="true"></i>Назад</a>

  <div class="mb-2">

    <div class="col-sm-3" style="display:inline-block;">

      <h1

        style="padding-bottom:10px; border-bottom:4px solid #FF8F88; font-size: 15px !important;width:150px !important">

        Баланс < 500 рублей</h1>

    </div>

    <div class="col-sm-3" style="display:inline-block;">

      <h1

        style="padding-bottom:10px; border-bottom:4px solid  #FFD37F; font-size: 15px !important;width:150px !important">

        Баланс >=500 рублей и <= 1650</h1>

    </div>

    <div class="col-sm-3" style="display:inline-block;">

      <h1

        style="padding-bottom:10px; border-bottom:4px solid #9CE1C6; font-size: 15px !important;width:150px !important">

        Баланс > 1650 рублей</h1>

    </div>

  </div>



  <div class="mb-2">

    <div class="col-sm-3" style="display:inline-block;">

      <svg enable-background="new 0 0 32 32" height="32px" id="svg2"

           version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"

      >

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

      <svg enable-background="new 0 0 32 32" height="32px" id="svg2"

           version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"

      >

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

      <svg enable-background="new 0 0 24 24" height="24px"

           id="Layer_1" version="1.1" viewBox="0 0 24 24" width="24px" xml:space="preserve"

           xmlns="http://www.w3.org/2000/svg">

         <path clip-rule="evenodd"

               d="M22.506,21v0.016L17,15.511V19c0,1.105-0.896,2-2,2h-1.5H3H2c-1.104,0-2-0.895-2-2  v-1l0,0V6l0,0V5c0-1.104,0.896-1.999,2-1.999h1l0,0h10.5l0,0H15c1.104,0,2,0.895,2,1.999v3.516l5.5-5.5V3.001  c0.828,0,1.5,0.671,1.5,1.499v15C24,20.327,23.331,20.996,22.506,21z"

               fill-rule="evenodd" />

       </svg>

      Смотрел видео

    </div>

  </div>

  @empty($lessons)

    <h4>Уроков ещё не было</h4>

  @else

    <table class="table table-striped table-hover table-bordered text-center"

           style="border:1px solid #eee;border-radius:10px !important;padding: 7px">

      <thead class="table-dark">

      <tr>

        <th scope="col" >Группа</th>

        <th scope="col" >Тема урока</th>

        <th scope="col" >Дата</th>

        <th scope="col" >Домашнее задание</th>

        <th scope="col" >Оплата</th>

        <th scope="col" >Стоимость урока</th>

      </tr>

      </thead>

      <tbody>

      @foreach ( $lessons as $lesson )

        <tr>

          <td>{{ $lesson['name_group'] }}</td>

          <td>{{ $lesson['lesson']->lesson_theme }}</td>

          <td>{{ date("d.m.Y",strtotime($lesson['lesson']->date)) }}</td>

          <td>{{ $lesson['lesson']->homework }}</td>

          <td style="background: {{ $lesson['color'] }}">{!! $payments[$lesson['lesson']->payment_status] !!}</td>

          <td>{{ $lesson['lesson']->lesson_cost }}</td>

        </tr>

      @endforeach

      </tbody>

    </table>

  @endempty

</div>