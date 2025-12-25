@extends('index')
@section('title','Главная')
@section('content')
<div class="container">
    <section class="hero">

        <h1 class="hero-title">Мониторинг качества образования</h1>
        <p>Профессиональный инструмент для анализа успеваемости и управления учебными данными.</p>
        <a href="{{route('login_web')}}" class="hero-but">Начать работу</a>

    </section>

    <section class="about">
        <h2 class="title">О проекте</h2>
        <p>Наша система — это цифровая среда, которая объединяет студентов, преподавателей и администрацию в едином информационном поле. Мы делаем процесс обучения прозрачным, а сбор данных — автоматическим.</p>
    </section>

    <section class="audience">

            <h2 class="title">Для кого это?</h2>
            <div class="grid-three">
                <div class="card">
                    <img src="{{ asset('images/student.png') }}" alt="student">
                    <h3>Студентам</h3>
                    <p>Персональный контроль успеваемости и всегда актуальное расписание в вашем кармане.</p>
                </div>

                <div class="card">
                    <img src="{{ asset('images/teacher.png') }}" alt="teacher">
                    <h3>Преподавателям</h3>
                    <p>Автоматизация отчетности и удобный инструмент для ведения электронного журнала.</p>
                </div>

                <div class="card">
                    <img src="{{ asset('images/admin.png') }}" alt="admin">
                    <h3>Админам</h3>
                    <p>Глубокая аналитика и инструменты для принятия управленческих решений.</p>
                </div>
            </div>

    </section>

    <section class="stats">
        <div class="grid-three">
            <div class="item">
                <div class="number">15+</div>
                <p>Отделений</p>
            </div>
            <div class="item">
                <div class="number">100%</div>
                <p>Цифровой учет</p>
            </div>
            <div class="item">
                <div class="number">24/7</div>
                <p>Доступ к данным</p>
            </div>
        </div>
    </section>
</div>


@endsection
