@extends('index')
@section('title', 'Профиль')
@section('content')
    <div class="container">
        <section class="profile">

            <section class="profile-side">
                <img src="{{asset('images/user.png')}}" class="avatar" alt="user">
                <h2 class="user-name">Иван Иванов</h2>
                <p class="role">Студент</p>


                    <form action="#" method="POST">
                        <button type="submit" class="but but-exit">Выйти</button>
                    </form>

            </section>

            <section class="profile-info">

                <div class="info-card">
                    <h3>Личные данные</h3>
                    <div class="info">
                        <p>Имя:</p>
                        <p>Иван</p>
                    </div>
                    <div class="info">
                        <p>Фамилия:</p>
                        <p>Иванов</p>
                    </div>
                    <div class="info">
                        <p>Номер зачетки:</p>
                        <p>#123456</p>
                    </div>
                </div>

                <div class="info-card">
                    <h3>Учебная информация</h3>
                    <div class="info">
                        <p>Группа:</p>
                        <p>ИС-151</p>
                    </div>
                    <div class="info">
                        <p>Отделение:</p>
                        <p>Информационные технологии</p>
                    </div>
                </div>

                <div class="info-card">
                    <h3>Данные аккаунта</h3>
                    <div class="info">
                        <p>Создан:</p>
                        <p>20.10.2023</p>
                    </div>
                    <div class="info">
                        <p>Обновлен:</p>
                        <p>Сегодня</p>
                    </div>
                </div>

            </section>
        </section>
        <section class="marks">
            <div class="info-card">
                <h3>Успеваемость (оценки)</h3>
                    <table>
                        <thead>
                        <tr>
                            <th>Дисциплина</th>
                            <th>Вид контроля</th>
                            <th>Дата</th>
                            <th>Оценка</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>МДК 03.01</td>
                            <td>Практическая работа</td>
                            <td>14.12.2025</td>
                            <td>5</td>
                        </tr>
                        </tbody>
                    </table>
            </div>
        </section>
    </div>
@endsection
