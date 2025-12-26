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

                const email = document.getElementById('email').value.trim();
                const password = document.getElementById('password').value;

                try {
                    console.log('Отправка запроса на вход...');

                    // ВАЖНО: Получаем CSRF токен правильно
                    const csrfToken = document.querySelector('input[name="_token"]')?.value ||
                        document.querySelector('meta[name="csrf-token"]')?.content ||
                        '';

                    console.log('CSRF Token:', csrfToken ? 'Получен' : 'Не найден');

                    const response = await fetch('/api/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            email: email,
                            password: password
                        })
                    });

                    console.log('Статус ответа:', response.status);

                    // Проверяем заголовки Content-Type
                    const contentType = response.headers.get('content-type');
                    console.log('Content-Type:', contentType);

                    let data;
                    if (contentType && contentType.includes('application/json')) {
                        data = await response.json();
                    } else {
                        const text = await response.text();
                        console.error('Не JSON ответ:', text);
                        throw new Error('Сервер вернул не JSON ответ');
                    }

                    console.log('Данные ответа:', data);

                    if (response.ok) {
                        console.log('Успешная авторизация!');
                        localStorage.setItem('token', data.token);
                        localStorage.setItem('user', JSON.stringify(data.user));
                        window.location.href = '/profile';
                    } else {
                        console.error('Ошибка от сервера:', data);
                        alert(data.error || `Ошибка авторизации. Код: ${response.status}`);
                    }
                } catch (error) {
                    console.error('Ошибка запроса:', error);
                    alert('Ошибка: ' + error.message);
                }
            });
        });
    </script>
@endsection
@vite('resources/js/student.js')
