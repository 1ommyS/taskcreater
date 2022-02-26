<!doctype html>

<html lang="ru">

<head>
  <title>Testing | @section('title') @show</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="shortcut icon" href=" {{ asset('public/img/landing/favicon.ico') }}">
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.css"
    rel="stylesheet"
  />
  {{--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">--}}

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- MDB -->
  <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.js"
  ></script>
  <link rel="stylesheet" href="{{ asset("public/css/forms.css") }}">
  <link rel="stylesheet" href="{{ asset("public/css/app.css") }}">
  <style>
      .btn-active {
          padding: 5px;
          font-weight: 500;
          color: #06c631 !important;
          border: 1px solid rgb(6, 198, 49);
          font-size: 15px !important;
          text-transform: none;
          border-radius: 4px;

      }

      .btn-deactivated {
          padding: 5px;
          font-weight: 500;
          color: #c6060c !important;
          border: 1px solid rgb(198, 6, 12);
          font-size: 15px !important;
          text-transform: none;
          border-radius: 4px;

      }
  </style>
</head>
<body>


@yield('content')
</body>

</html>

