<!doctype html>

<html lang="ru">

<head>
  <title>IT-ПАРК | @section('title') @show</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <meta name="description" content="IT-ПАРК - Образовательный онлайн проект для начинающих программистов">
  <link rel="shortcut icon" href=" {{ asset('public/img/landing/favicon.ico') }}">

  <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
  />

{{--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">--}}

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <script src="https://kit.fontawesome.com/507cd0bc6d.js" crossorigin="anonymous"></script>
</head>
<body>


@yield('content')
</body>

</html>

