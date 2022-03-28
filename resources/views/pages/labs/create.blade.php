@extends('layouts.profile')

@section('title')Cоздать лабораторную работу @endsection


@section('content')
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
  <link rel="stylesheet" href="{{ asset('css/utils.css') }}">
  <style>
      .input_form {
          padding-left: 10px;
          border-bottom: 1px solid black;
          border-radius: 5px;
          width: 18rem;
          display: inline-block;
          margin-bottom: 1rem;
      }

      .input-form:focus, .input_form:hover, .input_form:active {
          box-shadow: -2px 2px 14px 1px rgba(0, 0, 0, 0.54);
      }
  </style>
  @include('pages.teacher.header')
    <div class="container-sm mt-2 table-responsive" style="padding:10px">
      @include('layouts.alerts')
      <form method="post" class="form">
        @csrf
        <div class="form-group">
          <div><input type="text" name="lab_name" class="form-control" required
                      placeholder="Название лабораторной работы"></div>

          <div id="alert" class="mt-2 alert alert-danger" role="alert" hidden>
            Проверьте правильность введеных данных.
          </div>

          <hr>
          <span>Сколько <label for="memory_type">(Бит/Байт/Кбайт/Мбайт)</label>
            <input id="memory_type"
                   required
                   name="memory_type_one"
                   placeholder="Бит/Байт/Кбайт/Мбайт"
                   class="input_form"> займет слово
            <input
              type="text" class="input_form"
              required
              placeholder="Введите слово" name="word_1"> в кодировке
            <input
              type="text"
              required
              id="format"
              placeholder="ASCII/КОИ8/UTF-8/UTF-16/UTF-32"
              class="input_form" name="encoding_type_one"><label
              for="format">(ASCII/КОИ8/UTF-8/UTF-16/UTF-32)</label></span>
        </div>
        <hr>
        <div class="form-group">
          <span>Считая, что каждый символ кодируется одним <label
              for="memory_type">(Бит/Байт/Кбайт/Мбайт),</label>
            <input id="memory_type"
                   required
                   placeholder="Бит/Байт/Кбайт/Мбайт"
                   name="memory_type_second"
                   class="input_form">оцените информационный объем следующего предложения:
            <input
              required
              type="text"
              name="sentence"
              class="input_form"
              style="width: 20rem">
                в кодировке

              <input type="text"
                     id="format"
                     required
                     placeholder="ASCII/КОИ8/UTF-8/UTF-16/UTF-32"
                     class="input_form" name="encoding_type_second"><label
              for="format">(ASCII/КОИ8/UTF-8/UTF-16/UTF-32)  </label>:
        </div>
        <br>
        <div class="form-group">
          <input type="number" required class="form-control" min="1" step="1" name="amount" placeholder="Количество заданий">
        </div>
        <div class="mt-3 text-center">
          <button type="submit" id="submit_button" class="btn btn-danger">Сгенерировать задания</button>
        </div>
      </form>
    </div>
{{--  <table class="table table-hover table-striped table-bordered table-sm">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--      <th>Название вида кодирования информация</th>--}}
{{--      <th>Выбор шаблона</th>--}}
{{--      <th>Шаблоны</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    <tr>--}}
{{--      <td>текст</td>--}}
{{--      <td><input type="checkbox">--}}
{{--        <input type="checkbox">--}}
{{--        <input type="checkbox">--}}
{{--      </td>--}}
{{--      <td>--}}
{{--        <ol>--}}
{{--          <li>Шаблон 1</li>--}}
{{--          <li>Шаблон 2</li>--}}
{{--          <li>Шаблон 3</li>--}}
{{--        </ol></td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--      <td>аудио</td>--}}
{{--      <td><input type="checkbox"></td>--}}
{{--      <td>--}}
{{--        <ol>--}}
{{--          <li>Шаблон 1</li>--}}
{{--          <li>Шаблон 2</li>--}}
{{--          <li>Шаблон 3</li>--}}
{{--        </ol></td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--      <td>графика</td>--}}
{{--      <td><input type="checkbox"></td>--}}
{{--      <td>--}}
{{--        <ol>--}}
{{--          <li>Шаблон 1</li>--}}
{{--          <li>Шаблон 2</li>--}}
{{--          <li>Шаблон 3</li>--}}
{{--        </ol></td>--}}
{{--    </tr>--}}
{{--    </tbody>--}}
{{--  </table>--}}
  <script>
    const memoryTypes = "Бит/Байт/Кбайт/Мбайт".split("/");
    const formatTypes = "ASCII/КОИ8/UTF-8/UTF-16/UTF-32".split("/");

    const memoryTypesInputs = document.querySelectorAll("#memory_type");
    const formatTypesInputs = document.querySelectorAll("#format");

    memoryTypesInputs.forEach(input => input.addEventListener("input", (event) => {
      if (memoryTypes.indexOf(event.target.value) === -1) {
        document.querySelector("#alert").hidden = false;
        document.querySelector("#submit_button").disabled = true;
      } else {
        document.querySelector("#alert").hidden = true;
        document.querySelector("#submit_button").disabled = false;
      }
    }))

    formatTypesInputs.forEach(input => input.addEventListener("input", (event) => {
      if (formatTypes.indexOf(event.target.value) === -1) {
        document.querySelector("#alert").hidden = false;
        document.querySelector("#submit_button").disabled = true;
      } else {
        document.querySelector("#alert").hidden = true;
        document.querySelector("#submit_button").disabled = false;
      }
    }))
  </script>
@endsection

