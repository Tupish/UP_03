


document.addEventListener('DOMContentLoaded', function() {
    const role = document.getElementById('role');
    const group = document.getElementById('group');
    const grade = document.getElementById('grade');

    // Функция для показа/скрытия полей
    function toggleStudentFields() {
        if (role.value === 'student') {
            group.style.display = 'block';
            grade.style.display = 'block';
        } else {
            group.style.display = 'none';
            grade.style.display = 'none';
        }
    }

    // Вызываем при загрузке страницы (на случай, если уже выбрано значение)
    toggleStudentFields();

    // Слушаем изменение выбора роли
    role.addEventListener('change', toggleStudentFields);
});
