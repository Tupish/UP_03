@extends('index')
@section('title','Регистрация')
@section('content')
    <div class="container">


        <section class="form">

            <h3 class="title">Регистрация</h3>
            <form method="POST" action="{{route('login')}}" id="register">
                @csrf

                <label for="email">Почта</label>
                <input type="email" class="input" name="email" placeholder="exaple@mail.ru" required>

                <label for="password">Пароль</label>
                <input type="password" class="input" name="password" placeholder="Пароль" required>

                <label for="password">Имя</label>
                <input type="text" class="input" name="first_name" placeholder="Иван" required>

                <label for="password">Фамилия</label>
                <input type="text" class="input" name="last_name" placeholder="Иванов" required>



                <label for="role">Роль</label>
                <select name="role" id="role" default="">
                    <option value="student">Студент</option>
                    <option value="teacher" selected>Преподаватель</option>
                </select>

                <div id="group">
                    <label for="group">Группа</label>
                    <input name="group" required placeholder="is122" class="input">
                </div>


                <button type="submit" class="but">Зарегестрироваться</button>
            </form>
            <div class="other">
                <p>Есть аккаунт? <a href="{{route('login')}}">Войти</a></p>
            </div>

        </section>
    </div>
@endsection

