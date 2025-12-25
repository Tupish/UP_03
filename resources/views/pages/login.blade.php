@extends('index')
@section('title', 'Авторизация')
@section('content')
    <div class="container">
        <section class="form">
            <h2 class="title">Вход в аккаунт</h2>
            <form id="loginForm">
                @csrf

                <label for="email">Почта</label>
                <input type="email" class="input" id="email" name="email" placeholder="Введите почту" required>

                <label for="password">Пароль</label>
                <input type="password" class="input" id="password" name="password" placeholder="Введите пароль" required>

                <button type="submit" class="but">Войти</button>
            </form>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const token = localStorage.getItem('token');


            if (token) {
                window.location.href = '/profile';
                return;
            }

            loginForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                try {
                    const response = await fetch('/api/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({ email, password })
                    });

                    const data = await response.json();

                    if (response.ok) {

                        localStorage.setItem('token', data.token);
                        localStorage.setItem('user', JSON.stringify(data.user));

                        window.location.href = '/profile';
                    } else {

                        alert(data.error || 'Ошибка авторизации. Проверьте данные.');
                    }
                } catch (error) {
                    console.error('Ошибка запроса:', error);
                    alert('Не удалось связаться с сервером');
                }
            });
        });
    </script>
@endsection
