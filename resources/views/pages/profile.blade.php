@extends('index')
@section('title', 'Профиль')
@section('content')
    <div class="container">
        <section class="profile">
            <section class="profile-side">
                <img src="{{ asset('images/user.png') }}" class="avatar" alt="user">
                <h2 class="user-name" id="user-name">Загрузка...</h2>
                <p class="role" id="user-role">Загрузка...</p>

                <button type="button" onclick="handleLogout()" class="but but-exit">
                    Выйти
                </button>
            </section>

            <section class="profile-info">
                <div class="info-card">
                    <h3>Личные данные</h3>
                    <div class="info">
                        <p>Имя:</p>
                        <p id="first-name">Загрузка...</p>
                    </div>
                    <div class="info">
                        <p>Фамилия:</p>
                        <p id="last-name">Загрузка...</p>
                    </div>
                    <div class="info">
                        <p>Email:</p>
                        <p id="user-email">Загрузка...</p>
                    </div>
                    <div class="info" id="grade-book-container">
                        <p>Номер зачетки:</p>
                        <p id="grade-book">Загрузка...</p>
                    </div>
                </div>

                <div class="info-card" id="academic-info">
                    <h3>Учебная информация</h3>
                    <div class="info">
                        <p>Группа:</p>
                        <p id="group">Загрузка...</p>
                    </div>
                    <div class="info">
                        <p>Отделение:</p>
                        <p id="department">Загрузка...</p>
                    </div>
                    <div class="info">
                        <p>Роль:</p>
                        <p id="role-text">Загрузка...</p>
                    </div>
                </div>

                <div class="info-card">
                    <h3>Данные аккаунта</h3>
                    <div class="info">
                        <p>Создан:</p>
                        <p id="create">Загрузка...</p>
                    </div>
                    <div class="info">
                        <p>Обновлен:</p>
                        <p id="update">Загрузка...</p>
                    </div>
                </div>

            </section>
        </section>

        <!-- Секция для студента (его оценки) -->
        <section class="marks" id="student-marks-section" style="display: none;">
            <div class="info-card">
                <h3>Мои оценки</h3>
                <table>
                    <thead>
                    <tr>
                        <th>Дисциплина</th>
                        <th>Вид контроля</th>
                        <th>Дата</th>
                        <th>Оценка</th>
                    </tr>
                    </thead>
                    <tbody id="student-marks-table">
                    <tr>
                        <td colspan="4">Загрузка данных...</td>
                    </tr>
                    </tbody>
                </table>
                <div id="student-pagination"></div>
            </div>
        </section>

        <!-- Секция для преподавателя (оценки, которые он поставил) -->
        <section class="marks" id="teacher-marks-section" style="display: none;">
            <div class="info-card">
                <h3>Поставленные оценки</h3>
                <button onclick="openAddMarkModal()" class="but" style="margin-bottom: 20px; width: auto;">
                    + Добавить оценку
                </button>
                <table>
                    <thead>
                    <tr>
                        <th>Студент</th>
                        <th>Дисциплина</th>
                        <th>Вид контроля</th>
                        <th>Дата</th>
                        <th>Оценка</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody id="teacher-marks-table">
                    <tr>
                        <td colspan="6">Загрузка данных...</td>
                    </tr>
                    </tbody>
                </table>
                <div id="teacher-pagination"></div>
            </div>
        </section>

        <!-- Модальное окно для добавления/редактирования оценки -->
        <div id="mark-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
            <div style="background: white; margin: 50px auto; padding: 20px; width: 500px; border-radius: 10px;">
                <h3 id="modal-title">Добавить оценку</h3>
                <form id="mark-form">
                    <input type="hidden" id="edit-mark-id">

                    <div style="margin-bottom: 15px;">
                        <label>Студент:</label>
                        <select id="student-select" required style="width: 100%; padding: 8px;">
                            <option value="">Выберите студента...</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label>Дисциплина:</label>
                        <select id="subject-select" required style="width: 100%; padding: 8px;">
                            <option value="">Выберите дисциплину...</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label>Вид контроля:</label>
                        <input type="text" id="control-type" required style="width: 100%; padding: 8px;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label>Дата:</label>
                        <input type="date" id="mark-date" required style="width: 100%; padding: 8px;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label>Оценка:</label>
                        <select id="mark-value" required style="width: 100%; padding: 8px;">
                            <option value="">Выберите оценку...</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="зачет">Зачет</option>
                            <option value="незачет">Незачет</option>
                        </select>
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="button" onclick="saveMark()" class="but">Сохранить</button>
                        <button type="button" onclick="closeModal()" class="but" style="background: #ccc;">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const id = (e) => document.getElementById(e);
        let currentUserRole = null;

        function handleLogout() {
            localStorage.removeItem('token');
            window.location.href = '/auth/login';
        }

        document.addEventListener('DOMContentLoaded', async () => {
            const token = localStorage.getItem('token');
            if (!token) {
                window.location.href = '/auth/login';
                return;
            }

            try {
                const response = await fetch('/api/profile', {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    if (response.status === 401) {
                        localStorage.removeItem('token');
                        window.location.href = '/auth/login';
                        return;
                    }
                    throw new Error(`Ошибка сервера: ${response.status}`);
                }

                const user = await response.json();
                currentUserRole = user.role_id || (user.role ? user.role.role_id : null);

                // Заполняем профиль
                id('user-name').textContent = `${user.first_name || ''} ${user.last_name || ''}`.trim() || 'Пользователь';
                id('first-name').textContent = user.first_name || 'Не указано';
                id('last-name').textContent = user.last_name || 'Не указано';
                id('user-email').textContent = user.email || 'Не указано';

                if (user.role) {
                    id('user-role').textContent = user.role.role_name || user.role.name || user.role;
                    id('role-text').textContent = user.role.role_name || user.role.name || user.role;
                } else if (user.role_id) {
                    const roleNames = {
                        1: 'Студент',
                        2: 'Преподаватель',
                    };
                    const roleName = roleNames[user.role_id] || `Роль #${user.role_id}`;
                    id('user-role').textContent = roleName;
                    id('role-text').textContent = roleName;
                }

                if (user.student) {
                    // Если студент
                    id('grade-book').textContent = user.student.grade_book || 'Не указано';
                    id('group').textContent = user.student.group?.group_name || 'Не указано';
                    id('department').textContent = user.student.department?.department_name || 'Не указано';

                    // Показываем секцию оценок студента
                    id('student-marks-section').style.display = 'block';
                    loadStudentMarks();
                } else if (user.teacher) {
                    // Если преподаватель
                    id('grade-book-container').style.display = 'none';
                    id('academic-info').style.display = 'none';

                    // Показываем секцию оценок преподавателя
                    id('teacher-marks-section').style.display = 'block';
                    loadTeacherMarks();
                } else {
                    // Если другая роль
                    id('grade-book-container').style.display = 'none';
                    id('academic-info').style.display = 'none';
                }

                if (user.created_at) {
                    id('create').textContent = new Date(user.created_at).toLocaleDateString('ru-RU');
                }
                if (user.updated_at) {
                    id('update').textContent = new Date(user.updated_at).toLocaleDateString('ru-RU');
                }

            } catch (error) {
                id('user-name').textContent = 'Ошибка загрузки';
                id('first-name').textContent = error.message;
            }
        });

        // ========== ФУНКЦИИ ДЛЯ СТУДЕНТА ==========
        async function loadStudentMarks() {
            const token = localStorage.getItem('token');
            if (!token) return;

            try {
                const response = await fetch('/api/student/marks', {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Ошибка загрузки');

                const data = await response.json();
                displayStudentMarks(data);

                if (data.links) {
                    renderStudentPagination(data);
                }
            } catch (error) {
                id('student-marks-table').innerHTML = '<tr><td colspan="4">Ошибка загрузки оценок</td></tr>';
            }
        }

        function displayStudentMarks(data) {
            const tableBody = id('student-marks-table');
            const items = data.data || [];

            if (!tableBody) return;
            tableBody.innerHTML = '';

            if (items.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="4">Оценок пока нет</td></tr>';
                return;
            }

            items.forEach(item => {
                const row = `<tr>
                    <td>${item.subject ? item.subject.subject_name : '—'}</td>
                    <td>${item.control_type || 'Текущий'}</td>
                    <td>${item.date ? item.date.split('-').reverse().join('.') : '—'}</td>
                    <td><strong>${item.value || '—'}</strong></td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        }

        function renderStudentPagination(data) {
            const paginationElement = id("student-pagination");
            if (!paginationElement || !data.links) return;

            if (data.meta && data.meta.last_page <= 1) {
                paginationElement.style.display = 'none';
                return;
            }

            paginationElement.innerHTML = '';

            if (data.links.prev) {
                const prevBtn = document.createElement("button");
                prevBtn.innerHTML = '«';
                prevBtn.classList.add("p-3");
                prevBtn.addEventListener('click', () => loadStudentMarks(data.links.prev));
                paginationElement.appendChild(prevBtn);
            }

            if (data.meta) {
                const pageBtn = document.createElement("button");
                pageBtn.innerHTML = data.meta.current_page;
                pageBtn.classList.add("p-3", "active");
                pageBtn.disabled = true;
                paginationElement.appendChild(pageBtn);
            }

            if (data.links.next) {
                const nextBtn = document.createElement("button");
                nextBtn.innerHTML = '»';
                nextBtn.classList.add("p-3");
                nextBtn.addEventListener('click', () => loadStudentMarks(data.links.next));
                paginationElement.appendChild(nextBtn);
            }
        }


        async function loadTeacherMarks() {
            const token = localStorage.getItem('token');
            if (!token) return;

            try {
                const response = await fetch('/api/teacher/marks', {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Ошибка загрузки');

                const data = await response.json();
                displayTeacherMarks(data);

                if (data.links) {
                    renderTeacherPagination(data);
                }
            } catch (error) {
                id('teacher-marks-table').innerHTML = '<tr><td colspan="6">Ошибка загрузки оценок</td></tr>';
            }
        }

        function displayTeacherMarks(data) {
            const tableBody = id('teacher-marks-table');
            const items = data.data || [];

            if (!tableBody) return;
            tableBody.innerHTML = '';

            if (items.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="6">Вы еще не поставили ни одной оценки</td></tr>';
                return;
            }

            items.forEach(item => {
                const row = `<tr>
                    <td>${item.student ? `${item.student.user?.first_name || ''} ${item.student.user?.last_name || ''}`.trim() || '—' : '—'}</td>
                    <td>${item.subject ? item.subject.subject_name : '—'}</td>
                    <td>${item.control_type || 'Текущий'}</td>
                    <td>${item.date ? item.date.split('-').reverse().join('.') : '—'}</td>
                    <td><strong>${item.value || '—'}</strong></td>
                    <td>
                        <button onclick="editMark(${item.mark_id})" class="p-3" style="background: #4CAF50; color: white; border: none; margin-right: 5px;">✏️</button>
                        <button onclick="deleteMark(${item.mark_id})" class="p-3" style="background: #f44336; color: white; border: none;">🗑️</button>
                    </td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        }

        function renderTeacherPagination(data) {
            const paginationElement = id("student-pagination");
            if (!paginationElement || !data.links) return;

            if (data.meta && data.meta.last_page <= 1) {
                paginationElement.style.display = 'none';
                return;
            }

            paginationElement.innerHTML = '';

            if (data.links.prev) {
                const prevBtn = document.createElement("button");
                prevBtn.innerHTML = '«';
                prevBtn.classList.add("p-3");
                prevBtn.addEventListener('click', () => loadStudentMarks(data.links.prev));
                paginationElement.appendChild(prevBtn);
            }

            if (data.meta) {
                const pageBtn = document.createElement("button");
                pageBtn.innerHTML = data.meta.current_page;
                pageBtn.classList.add("p-3", "active");
                pageBtn.disabled = true;
                paginationElement.appendChild(pageBtn);
            }

            if (data.links.next) {
                const nextBtn = document.createElement("button");
                nextBtn.innerHTML = '»';
                nextBtn.classList.add("p-3");
                nextBtn.addEventListener('click', () => loadStudentMarks(data.links.next));
                paginationElement.appendChild(nextBtn);
            }
        }

        function openAddMarkModal() {
            id('modal-title').textContent = 'Добавить оценку';
            id('edit-mark-id').value = '';
            id('mark-form').reset();
            loadStudentsForSelect();
            loadSubjectsForSelect();
            id('mark-modal').style.display = 'block';
        }

        function closeModal() {
            id('mark-modal').style.display = 'none';
        }

        async function loadStudentsForSelect() {
            const response = await fetch('/api/students', {
                headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') }
            });
            const students = await response.json();

            const select = id('student-select');
            select.innerHTML = '<option value="">Выберите студента...</option>';

            students.forEach(student => {
                const option = document.createElement('option');
                option.value = student.student_id;
                option.textContent = `${student.user?.first_name} ${student.user?.last_name} (${student.group?.group_name || 'Без группы'})`;
                select.appendChild(option);
            });
        }

        async function loadSubjectsForSelect() {

            const response = await fetch('/api/teacher/subjects', {
                headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') }
            });
            const subjects = await response.json();

            const select = id('subject-select');
            select.innerHTML = '<option value="">Выберите дисциплину...</option>';

            subjects.forEach(subject => {
                const option = document.createElement('option');
                option.value = subject.subject_id;
                option.textContent = subject.subject_name;
                select.appendChild(option);
            });
        }

        async function saveMark() {
            const token = localStorage.getItem('token');
            const markId = id('edit-mark-id').value;

            const markData = {
                student_id: id('student-select').value,
                subject_id: id('subject-select').value,
                control_type: id('control-type').value,
                date: id('mark-date').value,
                value: id('mark-value').value
            };

            const url = markId ? `/api/marks/${markId}` : '/api/marks';
            const method = markId ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(markData)
                });

                if (response.ok) {
                    closeModal();
                    loadTeacherMarks(); // Обновить таблицу
                } else {
                    alert('Ошибка сохранения');
                }
            } catch (error) {
                alert('Ошибка: ' + error.message);
            }
        }

        async function editMark(markId) {
            const response = await fetch(`/api/marks/${markId}`, {
                headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') }
            });

            if (response.ok) {
                const mark = await response.json();

                id('modal-title').textContent = 'Редактировать оценку';
                id('edit-mark-id').value = markId;
                id('student-select').value = mark.student_id;
                id('subject-select').value = mark.subject_id;
                id('control-type').value = mark.control_type;
                id('mark-date').value = mark.date;
                id('mark-value').value = mark.value;

                // Нужно загрузить списки
                loadStudentsForSelect().then(() => {
                    id('student-select').value = mark.student_id;
                });
                loadSubjectsForSelect().then(() => {
                    id('subject-select').value = mark.subject_id;
                });

                id('mark-modal').style.display = 'block';
            }
        }

        async function deleteMark(markId) {
            if (!confirm('Удалить эту оценку?')) return;

            const response = await fetch(`/api/marks/${markId}`, {
                method: 'DELETE',
                headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') }
            });

            if (response.ok) {
                loadTeacherMarks(); // Обновить таблицу
            } else {
                alert('Ошибка удаления');
            }
        }
    </script>
@endsection
