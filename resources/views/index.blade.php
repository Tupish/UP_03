<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite('resources/css/style.css')
</head>
<body>
<header>
    @include('includes.header')
</header>

<main>
    @yield('content')
</main>

<footer>
    @include('includes.footer')
</footer>
</body>
@vite('resources/js/script.js')
@vite('resources/js/student.js')
</html>
