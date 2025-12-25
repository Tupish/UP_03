document.getElementById('register-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());


    const response = await fetch('/api/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();

    if (response.ok) {
        if (result.access_token) {
            localStorage.setItem('bearer_token', result.access_token);
        }
        alert('Регистрация успешна!');
        window.location.href = '/profile';
    } else {
        alert('Ошибка: ' + (result.message || 'Неизвестная ошибка'));
    }
});
