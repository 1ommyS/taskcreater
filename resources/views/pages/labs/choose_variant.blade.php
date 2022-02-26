@extends('layouts.profile')

@section('title')Выбор вариантов@endsection


@section('content')
  <style>
      .card {
          margin-bottom: 2rem;
      }
  </style>
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
  <link rel="stylesheet" href="{{ asset('css/utils.css') }}">
  @include('pages.teacher.header')
  <div class="container mt-2 table-responsive" style="padding:10px">
    @include('layouts.alerts')
    <form method="POST">
      @csrf
      <table id="selectedColumn" class="table table-hover table-striped table-bordered table-sm"
             style="border:1px solid #ccc;border-radius:10px !important;padding: 7px">
        <thead class="table-dark">
        <tr>
          <th scope="col" style="border-right: 2px solid #eee;font-weight:bold !important;">Номер</th>
          <th>Задачи</th>
        </tr>
        </thead>
        <tbody>
        @for($i=1;$i<=$amount;$i++)
          @if ($amount*$i <= count($variants_to_accept))
            <tr>
              <td><input type="checkbox"
                         name="{{ $variants_to_accept[0]->id+$amount*($i-1) }}-{{   $variants_to_accept[0]->id+ $amount*$i }}">
              </td>
              <td>
                @foreach($variants_to_accept as $k => $variant)
                  @if ($k >= $amount*($i-1) and $k< ($amount*$i))
                    <p>{{ $variant->question }}</p>
                  @endif
                @endforeach</td>
            </tr>
          @endif
        @endfor
        </tbody>
      </table>
      <div>
        <button type="submit" class="btn-success btn">Выбрать вариант</button>
      </div>
    </form>
  </div>

@endsection

