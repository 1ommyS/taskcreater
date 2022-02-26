@extends('layouts.profile')

@section('title')Cоздать лабораторную работу @endsection


@section('content')
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
  <link rel="stylesheet" href="{{ asset('css/utils.css') }}">
  @include('pages.teacher.header')
  <div class="container-sm mt-2 table-responsive" style="padding:10px">
    @include('layouts.alerts')
    <form method="post" class="form">
      @csrf
      <div class="form-group">
        <div><input type="text" name="lab_name" class="form-control" placeholder="Название лабораторной работы"></div>

        <span>Сколько <label for="memory_type">(Бит/Байт/Кбайт/Мбайт/Бит)</label> <textarea id="memory_type" rows="1"
                                                                                            name="memory_type_one"
                                                                                            class="form-control"></textarea> займет слово <input
            type="text" class="form-control" name="word_1"> в кодировке <input
            type="text"
            id="format"
            class="form-control" name="encoding_type_one"><label
            for="format">(ASCII/КОИ8/UTF-8/UTF-16/UTF-32)</label></span>
      </div>
      <br><br><br><br><br>
      <div class="form-group">
        <span>Считая, что каждый символ кодируется одним <label
            for="memory_type">(Бит/Байт/Кбайт/Мбайт/Бит),</label> <textarea id="memory_type" rows="1"
                                                                            name="memory_type_second"
                                                                            class="form-control"></textarea>оцените информационный объем следующего предложения: <input
            type="text" name="sentence" class="form-control"> в кодировке
            <input type="text"
                   id="format"
                   class="form-control" name="encoding_type_second"><label
            for="format">(ASCII/КОИ8/UTF-8/UTF-16/UTF-32)  </label>:
      </div>
      <br>
      <div class="form-group">
        <input type="number" class="form-control" min="1" step="1" name="amount" placeholder="Количество заданий">
      </div>
      <div class="mt-3 text-center">
        <button type="submit" class="btn btn-danger">Сгенерировать задания</button>
      </div>
    </form>
  </div>
@endsection

