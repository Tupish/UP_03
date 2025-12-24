@extends('index')
@section('title', 'Профиль')
@section('content')
    <div class="container">
        <section class="profile">

            <section class="profile-side">
                <img src="{{asset('images/user.png')}}" class="avatar" alt="user">
                <h2 class="user-name">...</h2>
                <p class="role">...</p>


                    <form action="#" method="POST">
                        <button type="submit" class="but but-exit">Выйти</button>
                    </form>

            </section>

            <section class="profile-info">

                <div class="info-card">
                    <h3>Личные данные</h3>
                    <div class="info">
                        <p>Имя:</p>
                        <p id="first-name">...</p>
                    </div>
                    <div class="info">
                        <p>Фамилия:</p>
                        <p id="last-name">...</p>
                    </div>
                    <div class="info">
                        <p>Номер зачетки:</p>
                        <p id="grade-book">...</p>
                    </div>
                </div>

                <div class="info-card">
                    <h3>Учебная информация</h3>
                    <div class="info">
                        <p>Группа:</p>
                        <p id="group">...</p>
                    </div>
                    <div class="info">
                        <p>Отделение:</p>
                        <p id="department">...</p>
                    </div>
                </div>

                <div class="info-card">
                    <h3>Данные аккаунта</h3>
                    <div class="info">
                        <p>Создан:</p>
                        <p id="create">...</p>
                    </div>
                    <div class="info">
                        <p>Обновлен:</p>
                        <p id="update">...</p>
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
                        <tbody id="marks-table">
                        <tr>
                            <td colspan="4">Загрузка...</td>
                        </tr>
                        </tbody>
                    </table>
                <div id="pagination"></div>
            </div>
        </section>
    </div>
@endsection

