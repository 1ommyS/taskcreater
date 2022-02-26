@extends("layouts.profile")

@section("title") Информация об ученике @endsection



@section('content')

    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">


    @if(Auth::user()->role_id == 2)
        @include('pages.teacher.header')
    @endif

    <div class="container table-responsive">
        @empty($student_info)
            <h1>Пользователя не существует</h1>
        @else
            <div class="mt-2">
                <h1>
                    <a href="/group/{{$group_id}}" class="btn-sm btn-orange"
                       style="cursor:pointer;color:white;border:1px solid #eee;padding-left:20px;padding-right:20px"> <i
                                class="fa fa-arrow-left" aria-hidden="true"></i>Назад</a>
                </h1>
            </div>
            @include('layouts.alerts')
            <table class="table table-striped table-hover table-bordered  mt-2"
                   style="padding:30px; border:1px solid #ccc; border-radius:7px">
                <thead class="table-dark">
                <th>Графа</th>
                <th>Значение</th>
                </thead>
                <tbody>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">Номер аккаунта</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;">{{ $student_info->id }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">Логин</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;">{{ $student_info->login }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">Имя ученика</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;">{{ $student_info->name }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">Номер телефона</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;">{{ $student_info->phone_student }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">Страница ВК</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;">{{ $student_info->link_vk }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">ФИО Родителя</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;">{{ $student_info->name_parent }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">Телефон Родителя</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;">{{ $student_info->phone_parent }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">День рождения</td>
                    <td
                            style="border:1px solid #ccc;border-radius: 7px;">{{ date('d.m.Y',strtotime($student_info->birthday)) }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">Город</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;">{{ $student_info->city }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">Пол</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;">@if( $student_info->sex == 1 ) Мужской @elseif($student_info->sex==2) Женский @else Не установлен@endif </td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">Возраст</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;">{{ $ages[$student_info->age] }}</td>
                </tr>

                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">Выпускался ли из какой-то группы</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;">{{ $finished[$student_info->finished] }}</td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;border-radius: 7px;">Льготник</td>

                    @if($exempt)
                        <td style="border:1px solid #ccc;border-radius: 7px;"><a
                                    class="btn btn-sm btn-orange"
                                    href="/group/offexempt/{{$student_id}}/{{$group_id}}">Отменить льготу</a></td>
                    @else
                        <td style="border:1px solid #ccc;border-radius: 7px;"><a
                                    class="btn btn-sm btn-orange"
                                    href="/group/exempt/{{$student_id}}/{{$group_id}}">Сделать льготником</a></td>
                    @endif
                </tr>
                <tr>
                    <td>Ученик группы</td>
                    <td style="border:1px solid #ccc;border-radius: 7px;"><a
                                class="btn btn-sm btn-orange"
                                href="/group/delete/{{$student_id}}/{{$group_id}}">Удалить из группы</a></td>
                </tr>

                </tbody>
            </table>
            <div class="table-responsive">
                <h3 class="text-center mt-5 mb-4">История оплат</h3>
                <table class="table table-striped table-bordered mt-2 text-center"
                       style="padding: 30px !important; border:1px solid #ccc; border-radius:5px !important;">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">Дата перевода</th>
                        <th scope="col">Сумма перевода</th>
                        <th scope="col">Кол-во занятий</th>
                        <th scope="col">Кол-во бонусных занятий</th>
                    </tr>
                    </thead>
                    <tbody>
                    @empty('transactions')
                        <h1>У вас ещё не было оплат</h1>
                    @else
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ date("d.m.Y H:i:s",strtotime($transaction->date_transaction)) }}</td>
                                <td>{{ $transaction->sum_transaction }}</td>
                                <td>{{ $transaction->count_lessons }}</td>
                                <td>{{ $transaction->count_bonus_lessons }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endempty
            </div>
            <h3 class="text-center mb-2 mt-5">Добавление оплаты</h3>
            <form style="padding:25px; border:1px solid #ccc; border-radius:5px;"
                  action="/group/payment/{{$student_id}}/{{$group_id}}"
                  class="form" method="POST">
                @csrf
                <input type="number" name="value" class="form-control"
                       placeholder="Количество денег для добавления на счёт"
                       required>
                <br>
                <input type="date" name="date" class="form-control" placeholder="Дата пополнения"
                       required>
                <div class="form-group text-center">
                    <button type="submit" style="color:#fff;" class="btn btn-orange text-center mt-1">Добавить</button>
                </div>
            </form>

            <h3 class="text-center mb-2 mt-5">Добавление бонусов</h3>
            <form style="padding:25px; border:1px solid #ccc; border-radius:5px;"
                  action="/group/bonus/{{$student_id}}/{{$group_id}}"
                  class="form"
                  method="POST">
                @csrf
                <input type="number" name="value" class="form-control"
                       placeholder="Сумма в бонусах для добавления на счёт"
                       required>
                <div class="form-group text-center">
                    <button type="submit" style="color:#fff;" class="btn btn-orange text-center mt-1">Добавить</button>
                </div>
            </form>

            <h3 class="text-center mb-2 mt-5">Добавление Достижения</h3>
            <form style="padding:25px; border:1px solid #ccc; border-radius:5px;"
                  action="/group/achievement/{{$student_id}}/{{$group_id}}"
                  class="form"
                  method="POST">
                @csrf
                <input type="text" name="name" class="form-control"
                       placeholder="Название достижения"
                       required>
                <div class="form-group text-center">
                    <button type="submit" style="color:#fff;" class="btn btn-orange text-center mt-1">Добавить</button>
                </div>
            </form>
            <h3 class="text-center mb-2 mt-5">Добавить баллов (сейчас: {{$current_point->value ?? "Не устанавливалось"}})</h3>
            <form style="padding:25px; border:1px solid #ccc; border-radius:5px;"
                  action="/group/points/{{$student_id}}/{{$group_id}}"
                  class="form"
                  method="POST">
                @csrf
                <input type="number" name="points" class="form-control"
                       placeholder="Количество баллов"
                       required>
                <div class="form-group text-center">
                    <button type="submit" style="color:#fff;" class="btn btn-orange text-center mt-1">Добавить</button>
                </div>
            </form>
            <h3 class="text-center mb-2 mt-5">Перевод в другую группу</h3>
            <form style="padding:25px; border:1px solid #ccc; border-radius:5px;"
                  action="/group/transfer/{{$student_id}}/{{$group_id}}"
                  class="form"
                  method="POST">
                @csrf
                    <input type="text" class="input100" placeholder="Название группы" id="inputgroup">
                    <select name="group" required class="form-control" id="groups">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name_group }}</option>
                        @endforeach
                    </select>
                <script>
                  document.querySelector("#inputgroup").addEventListener("input", (e) => {
                    document.querySelectorAll("option").forEach((element) => {
                      if (
                        !element.textContent.toLowerCase().includes(e.target.value.toLowerCase())
                      ) {
                        element.style = "display:none";
                      } else {
                        element.style = "display:block";
                      }
                    });
                  });

                </script>
                <div class="form-group text-center">
                    <button type="submit" style="color:#fff;" class="btn btn-orange text-center mt-1">Перевести</button>
                </div>
            </form>

    </div>
    @endempty
    <style>
        th:after {
            content: "" !important;
        }
    </style>
@endsection