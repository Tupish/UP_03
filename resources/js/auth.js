document.getElementById('register-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch('/api/registration', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            localStorage.setItem('bearer_token', result.access_token);
            alert('Регистрация успешна!');
            window.location.href = '/profile';
        } else {
            alert('Ошибка: ' + (result.message));
        }
    } catch (error) {
        console.error('Ошибка сети:', error);
    }
});
