@extends('index')
@section('title','Регистрация')
@section('content')
    <div class="container">
        <img src="{{asset('images/nmk.webp')}}" alt="nmk icon" class="icon">

        <section class="form">

            <h2 class="title">Регистрация</h2>
            <form method="POST" action="{{route('login')}}">
                @csrf

                <label for="email">Почта</label>
                <input type="email" class="input" name="email" placeholder="Введите почту" required>

                <label for="password">Пароль</label>
                <input type="password" class="input" name="password" placeholder="Введите пароль" required>




                <button type="submit" class="but">Зарегестрироваться</button>
            </form>
            <div class="other">
                <p>Есть аккаунт? <a href="{{route('login')}}">Войти</a></p>
            </div>

        </section>
    </div>
@endsection

