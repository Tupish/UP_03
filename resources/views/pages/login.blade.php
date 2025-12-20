@extends('index')
@section('title','Авторизация')
@section('content')

    <div class="container">
        <img src="{{asset('images/nmk.webp')}}" alt="nmk icon" class="icon">

        <section class="form">

            <h2 class="title">Вход в аккаунт</h2>
            <form method="POST" action="{{route('login')}}">
                @csrf

                <label for="email">Почта</label>
                <input type="email" class="input" name="email" placeholder="Введите почту" required>

                <label for="password">Пароль</label>
                <input type="password" class="input" name="password" placeholder="Введите пароль" required>

                <button type="submit" class="but">Войти</button>
            </form>
            <div class="other">
                <p>Нет аккаунта? <a href="{{route('register')}}">Регистрация</a></p>
            </div>
        </section>
    </div>




@endsection
