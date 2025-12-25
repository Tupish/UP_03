@extends('index')
@section('title','Регистрация')
@section('content')
    <div class="container">


        <section class="form">

            <h3 class="title">Регистрация</h3>
            <form method="POST" action="{{route('view.register')}}" id="register-form">
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
                    <option value="1" selected>Студент</option>
                    <option value="2">Преподаватель</option>
                </select>

                <div id="grade">
                    <label for="grade">Номер зачетной книжки</label>
                    <input name="grade" required placeholder="123456" class="input">
                </div>

                <div id="group">
                    <label for="group">Группа</label>
                    <input name="group" required placeholder="is122" class="input">
                </div>


                <button type="submit" class="but">Зарегестрироваться</button>
            </form>
            <div class="other">
                <p>Есть аккаунт? <a href="{{route('view.login')}}">Войти</a></p>
            </div>

        </section>
    </div>
@endsection

<script>
    id('register-form').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData.entries());

        const response = await fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector(`meta[name="csrf-token"]`).content
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            window.location.href = '/profile';
        } else {
            alert('Ошибка при регистрации');
        }
    });
</script>
