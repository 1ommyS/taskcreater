@extends("layouts.profile")

@section("title") История платежей @endsection

@section('content')
  @include('pages.teacher.header')

  <div class="dashboard">
    <div class="dashboard__amounts" style="border:1px solid #eee; padding:25px; border-radius:7px; margin-top:2px;">
      <h4 class="text-center">История платежей</h4>

      <div class="accordion" id="accordionExample">
        <div class="container-fluid">

          <div class=" table-responsive">
            <table class="table table-hover table-striped table-bordered text-center">
              <thead class="table-dark">
              <th>Дата операции</th>
              <th>Название операции</th>
              <th>Сумма</th>
              </thead>
              <tbody>
              <tr>
                <td>БАЛАНС:</td>
                <td>-</td>
                <td>{{$sum}} ₽</td>
              </tr>
              @foreach($information_on_the_month as $salary)
                <tr>
                  <td>{{ \Carbon\Carbon::parse($salary["created_at"])->format("d.m.Y H:i:s") }}</td>
                  <td>
                    @if ($salary["type"] == 1)
                      Оплата за урок от {{\Carbon\Carbon::parse($salary["created_at"])->format("d.m.Y H:i:s")}} за
                      группу {{$salary["name_group"]}}
                    @elseif ($salary["type"]==2)
                      Оплата зарплаты
                    @else
                      Оплата премии
                    @endif
                  </td>
                  <td>
                    {{$salary["value"]}}
                  </td>
                </tr>
              @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>


@endsection