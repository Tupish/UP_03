@extends('index')
@section('title','Регистрация')
@section('content')
    <h1>Регистрация</h1>
    <form class="form" method="post">
        <label for="email">Почта</label>
        <input type="email" class="input" name="email" placefolder="Введите почту" required>

        <label for="password">Пароль</label>
        <input type="password" class="input" name="password" placefolder="Введите пароль" required>

        <button type="submit">Войти</button>
    </form>
    <p>Есть аккаунт? <a href="{{route('login')}}">Войти</a></p>
@endsection

