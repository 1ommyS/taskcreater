<!doctype html>

<html lang="ru">

<head>
    <title>IT-ПАРК | @section('title') @show</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="IT-ПАРК - Образовательный онлайн проект для начинающих программистов">
    <link rel="shortcut icon" href=" {{ asset('public/img/landing/favicon.ico') }}">
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
            rel="stylesheet"
    />
    <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
    />
  {{--  <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.css"
            rel="stylesheet"
    />--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- MDB -->
    <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.0.0/mdb.min.js"
    ></script>
    <link rel="stylesheet" href="{{ asset("public/css/forms.css") }}">
    <link rel="stylesheet" href="{{ asset("public/css/app.css") }}">

</head>
<body>


@yield('content')
</body>

</html>

