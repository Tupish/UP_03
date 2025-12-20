@extends('index')
@section('title','Авторизация')
@section('content')
    <h1>Вход в аккаунт</h1>
    <form class="form" method="post">
        <label for="email">Почта</label>
        <input type="email" class="input" name="email" placefolder="Введите почту" required>

        <label for="password">Пароль</label>
        <input type="password" class="input" name="password" placefolder="Введите пароль" required>

        <button type="submit">Войти</button>
    </form>
    <p>Нет аккаунта? <a href="{{route('register')}}">Регистрация</a></p>
@endsection
