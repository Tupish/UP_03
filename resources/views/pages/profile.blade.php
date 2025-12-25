@extends('index')
@section('title', 'Профиль')
@section('content')
    <div class="container">
        <section class="profile">
            <section class="profile-side">
                <img src="{{ asset('images/user.png') }}" class="avatar" alt="user">
                <h2 class="user-name" id="user-name">...</h2>
                <p class="role" id="user-role">...</p>

                <button type="button" onclick="window.auth.handleLogout()" class="but but-exit">
                    Выйти
                </button>
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
                    <div class="info" id="grade-book-container">
                        <p>Номер зачетки:</p>
                        <p id="grade-book">...</p>
                    </div>
                </div>

                <div class="info-card" id="academic-info">
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

        <section class="marks" id="marks-section">
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
                        <td colspan="4">Загрузка данных...</td>
                    </tr>
                    </tbody>
                </table>
                <div id="pagination"></div>
            </div>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const token = localStorage.getItem('token');
            if (!token) { window.location.href = '/auth/login'; return; }

            try {
                const response = await fetch('/api/profile', {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const user = await response.json();

                    // Основные данные
                    document.querySelector('.user-name').textContent = `${user.first_name} ${user.last_name}`;
                    document.querySelector('.role').textContent = user.role_id === 1 ? 'Студент' : 'Преподаватель';
                    document.getElementById('first-name').textContent = user.first_name;
                    document.getElementById('last-name').textContent = user.last_name;
                    document.getElementById('create').textContent = new Date(user.created_at).toLocaleDateString();
                    document.getElementById('update').textContent = new Date(user.updated_at).toLocaleDateString();

                    // Учебная информация (только для студентов)
                    if (user.student) {
                        document.getElementById('grade-book').textContent = user.student.grade_book || 'Не указано';
                        document.getElementById('group').textContent = user.student.group ? user.student.group.group_name : 'Нет группы';
                        document.getElementById('department').textContent = user.student.department ? user.student.department.department_name : 'Нет отделения';

                        // Вывод оценок в таблицу
                        const marksTable = document.getElementById('marks-table');
                        marksTable.innerHTML = ''; // Очищаем "Загрузка..."

                        if (user.student.marks && user.student.marks.length > 0) {
                            user.student.marks.forEach(mark => {
                                const row = `
                            <tr>
                                <td>${mark.subject ? mark.subject.subject_name : 'Предмет удален'}</td>
                                <td>${mark.control_type || 'Текущий'}</td>
                                <td>${new Date(mark.created_at).toLocaleDateString()}</td>
                                <td><strong>${mark.mark}</strong></td>
                            </tr>
                        `;
                                marksTable.innerHTML += row;
                            });
                        } else {
                            marksTable.innerHTML = '<tr><td colspan="4">Оценок пока нет</td></tr>';
                        }
                    }
                }
            } catch (error) {
                console.error('Ошибка:', error);
            }
        });

        const logout = async () => {
            const token = localStorage.getItem('token');

            try {
                // Вызываем функцию logout из AuthController через API
                await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // На всякий случай для Laravel
                    }
                });
            } catch (e) {
                console.log('Сервер уже удалил токен или недоступен');
            }

            // Очищаем браузер в любом случае
            localStorage.clear();
            window.location.href = '/auth/login';
        };

        // Привязываем функцию к объекту window, чтобы onclick её видел
        window.auth = { handleLogout: logout };
    </script>
@endsection

