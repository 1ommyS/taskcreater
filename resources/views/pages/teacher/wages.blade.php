@extends("layouts.profile")

@section("title") Ваша зарплата @endsection

@section('content')
  @include('pages.teacher.header')

  <div class="dashboard">
    <div class="dashboard__amounts" style="border:1px solid #eee; padding:25px; border-radius:7px; margin-top:2px;">
      <h4 class="text-center">Сводная таблица</h4>
     <div class="dashboard__params mb-5" style="text-align: center">
        <input type="hidden" id="month" value="{{ $month  }}">
        <input type="hidden" id="year" value="{{$year}}">
        <form method="POST" class="form">
          @csrf
          <select name="month" style="width:150px">
            <option value="0" id="#month">Месяц
            </option>
            <option value="01" id="#month">Январь</option>
            <option value="02" id="#month">Февраль</option>
            <option value="03" id="#month">Март</option>
            <option value="04" id="#month">Апрель</option>
            <option value="05" id="#month">Май</option>
            <option value="06" id="#month">Июнь</option>
            <option value="07" id="#month">Июль</option>
            <option value="08" id="#month">Август</option>
            <option value="09" id="#month">Сентябрь</option>
            <option value="10" id="#month">Октябрь</option>
            <option value="11" id="#month">Ноябрь</option>
            <option value="12" id="#month">Декабрь</option>
          </select>
          <select name="year" id="">
           <option value="">Год</option>
           <option value="2020" id="year">2020</option>
            <option value="2021" id="year">2021</option>
            <option value="2022" id="year">2022</option>
            <option value="2023" id="year">2023</option>
            <option value="2024" id="year">2024</option>
            <option value="2025" id="year">2025</option>
          </select>
          <div class="form__submit">
            <button type="submit" class="btn btn-data text-center mt-2">Получить данные
            </button>
          </div>
        </form>
      </div>

      <script>
        const selectedMonth = document.querySelector("#month");
        if (!selectedMonth) {
          let month = new Date().getMonth() + 1;
         document.querySelector(`option[value="${month}"]`).setAttribute("selected", true);
          let year = new Date().getFullYear();
         document.querySelector(`option[value="${year}"]`).setAttribute("selected", true);
        } else {
          let month = selectedMonth.value;
          document.querySelector(`option[value="${month}"]`).setAttribute("selected", true);
          let year = document.querySelector("#year").value;
          document.querySelector(`option[value="${year}"]`).setAttribute("selected", true);
        }
      </script>
      <div class="accordion" id="accordionExample">
        <div class="container-fluid">
          @foreach($information as $index => $info)
            <div class="card mt-3">
              <div class="card-header" id="acc{{ $index }}">
                <button
                  class="btn btn-link"
                  type="button"
                  data-mdb-toggle="collapse"
                  data-mdb-target="#accounting{{ $index }}"
                  aria-expanded="false"
                  aria-controls="collapseExample"
                >
                  {{ $index + 1 }} неделя ( {{ implode(".",array_reverse(explode("-",$weeks[$index]['start'])))}}
                                   - {{ implode(".",array_reverse(explode("-",$weeks[$index]['end']))) }})
                </button>
              </div>
              <div id="accounting{{ $index }}" class="collapse" aria-labelledby="{{ $index }}"
                   data-parent="#accordionExample">
                <div class="card-body table-responsive">
                  <table class="table table-striped table-hover table-bordered text-center">
                    <thead class="table-dark">
                    <th>Имя преподавателя / название поля</th>
                    <th>Учеников выполняло ДЗ</th>
                    <th>Учеников не выполняло ДЗ</th>
                    <th>Учеников смотрело видео</th>
                    <th>Всего учеников (по факту)</th>
                    <th>Выручка</th>
                    <th>Зарплата</th>
                    <th>Премия</th>
                    <th>ЗП + премия</th>
                    </thead>
                    <tbody>
                    <tr>
                      <td>{{ $info['name'] }}</td>
                      <td id="accHM{{ $index + 1 }}">{{ $info['home']??0 }}</td>
                      <td id="accWHM{{ $index + 1 }}">{{ $info['without_home']??0 }}</td>
                      <td id="accVD{{ $index + 1 }}">{{ $info['video']??0 }}</td>
                      <td id="accAL{{ $index + 1 }}">{{ $info['all']??0 }}</td>
                      <td id="accRV{{ $index + 1 }}">{{ $info['revenue']??0 }}</td>
                      <td id="accWG{{ $index + 1 }}">{{ $info['wages']??0 }}</td>
                      <td id="accPrem{{ $index + 1 }}">{{ $info['premiums']??0 }}</td>
                      <td id="accFinals{{ $index + 1 }}">{{ $info['premiums_with_wages']??0 }}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          @endforeach
          {{--месяц--}}
          <div class="card mt-3">
            <div class="card-header" id="acc{{ count($weeks) }}">
              <button
                class="btn btn-link"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#accounting{{ count($weeks) }}"
                aria-expanded="false"
                aria-controls="collapseExample"
              >
                Месяц ({{ implode(".",array_reverse(explode("-",$weeks[0]['start']))) }}
                - {{ implode(".",array_reverse(explode("-",$weeks[count($weeks)-1]['end']))) }})
              </button>
            </div>
            <div id="accounting{{ count($weeks) }}" class="collapse" aria-labelledby="{{ count($weeks) }}"
                 data-parent="#accordionExample">
              <div class="card-body table-responsive">
                <table class="table table-hover table-striped table-bordered text-center">
                 <thead class="table-dark">
                  <th>Имя преподавателя / название поля</th>
                  <th>Учеников выполняло ДЗ</th>
                  <th>Учеников не выполняло ДЗ</th>
                  <th>Учеников смотрело видео</th>
                  <th>Всего учеников (по факту)</th>
                  <th>Выручка</th>
                  <th>Зарплата</th>
                  <th>Премия</th>
                  <th>ЗП + премия</th>
                  </thead>
                  <tbody>
                  <tr>
                    <td>{{ $information_on_the_month['name']??0 }}</td>
                    <td>{{ $information_on_the_month['home']??0 }}</td>
                    <td>{{ $information_on_the_month['without_home']??0 }}</td>
                    <td>{{ $information_on_the_month['video']??0 }}</td>
                    <td>{{ $information_on_the_month['all']??0 }}</td>
                    <td>{{ $information_on_the_month['revenue']??0 }}</td>
                    <td>{{ $information_on_the_month['wages']??0 }}</td>
                    <td>{{ $information_on_the_month['premiums'] ??0}}</td>
                    <td>{{ $information_on_the_month['premiums_with_wages'] }}</td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          {{--групповая--}}
          <div class="dashboard__information">
            <h1 class="text-center m-4">Аналитика по группам</h1>
            @empty($groups)
              <h6 class="text-center">Занятий ещё не было</h6>
            @endempty
            @foreach ( $groups  as $i => $group )
            <div class="information__teacher mb-5">
              <div class="container">
                <div class="accordion " id="accordionExample">
                  <div class="card mb-5">
                   <div class="card-header" id="heading:_fatw{{ $i}}sa{{$i*3}}>">
                     <button
                       class="btn btn-link"
                       type="button"
                       data-mdb-toggle="collapse"
                       data-mdb-target="#f{{ hash("haval128,3", $group["name_group"]) }}"
                       aria-expanded="false"
                       aria-controls="collapseExample"
                     >
                       {{$group['name_group']}} | {{$group['year']}} год обучения
                     </button>
                    </div>
                    <div id="f{{ hash("haval128,3", $group["name_group"]) }}"
                         class="collapse mb-5"
                         aria-labelledby="heading:_fatw{{$i }}sa{{$i*3 }}>"
                         data-parent="#accordionExample">
                      <div class="card-body table-responsive">
                        <table class="table table-hover table-striped table-bordered text-center">
                          <thead class="table-dark">
                          <th>Название графы</th>
                          <th>Значение</th>
                          </thead>
                          <tbody>
                          <tr>
                            <td>Количество учеников в группе</td>
                            <td>{{$group['amount'] }}</td>
                          </tr>
                          <tr>
                            <td>Возраст учеников</td>
                            <td>{{$group['age'] }}</td>
                          </tr>
                          </tbody>
                        </table>
                        @foreach ( $group['weeks'] as $index => $info )
                        <div class="accordion" id="accordionExample">
                          <div id="accounting{{$index}}" class="collapse show" aria-labelledby="acc{{$index}}"
                               data-parent="#accordionExample">
                            <div class="card mt-2">
                              <div class="card-header" id="age:{{$index}}/dafc::{{$index}}">
                                <button
                                  class="btn btn-link"
                                  type="button"
                                  data-mdb-toggle="collapse"
                                  data-mdb-target="#c{{ hash("haval128,3", $group["name_group"]) }}{{$index}}"
                                  aria-expanded="false"
                                  aria-controls="collapseExample"
                                >
                                  {{$index+1}} неделя
                                               ( {{ implode(".",array_reverse(explode("-",$weeks[$index]['start'])))}}
                                               - {{ implode(".",array_reverse(explode("-",$weeks[$index]['end']))) }})
                                </button>
                              </div>
                              <div
                                id="c{{ hash("haval128,3", $group["name_group"]) }}{{$index}}"
                                class="collapse"
                                aria-labelledby="age:{{$index}}/dafc::{{$index}}"
                                data-parent="#accordionExample">
                                <div class="card-body table-responsive">
                                  <table class="table table-hover table-striped table-bordered text-center">
                                    <thead class="table-dark">
                                    <th>Название графы
                                    </th>
                                    <th>Значение</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                      <td>Количество учеников, смотревших видео:</td>
                                      <td>{{ $info['video']??0 }}</td>
                                    </tr>
                                    <tr>
                                      <td>Количество учеников, выполняющих ДЗ:</td>
                                      <td>{{ $info['home'] ??0}}</td>
                                    </tr>
                                    <tr>
                                      <td>Количество учеников, не выполняющих ДЗ:</td>
                                      <td>{{ $info['no_home'] ??0}}</td>
                                    </tr>
                                    <tr>
                                      <td>Выручка:</td>
                                      <td>{{ $info['revenue']??0 }}</td>
                                    </tr>
                                    <tr>
                                      <td>Зарплата:</td>
                                      <td>{{ $info['wages'] ??0}}</td>
                                    </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                       </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
@endsection