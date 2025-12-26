const id = (e) => document.getElementById(e);
document.addEventListener('DOMContentLoaded', () => {
    if (id('marks-table')) {
        load_marks();
    }
});

async function load_marks(url = '/api/student/marks') {
    const token = localStorage.getItem('token');
    const tableBody = id('marks-table');

    if (!token) return;

    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            }
        });

        if (!response.ok) throw new Error('Ошибка загрузки');

        const data = await response.json();

        printMarks(data);

        if (data.links) {
            renderPagination(data);
        }

    } catch (error) {
        console.error('Ошибка:', error);
        if (tableBody) {
            tableBody.innerHTML = '<tr><td colspan="4">Не удалось загрузить оценки</td></tr>';
        }
    }
}

function printMarks(data) {

    const tableBody = id('marks-table');
    const items = data.data || [];

    if (items.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="4">Оценок пока нет</td></tr>';
        return;
    }

    items.forEach(item => {
        const row =
            `<tr>
                <td>${item['subject'] ? item.subject.subject_name : '—'}</td>
                <td>${item['control_type']}</td>
                <td>${item['date'] ? new Date(item['date']).toLocaleDateString('ru-RU') : '—'}</td>
                <td>${item['value']}</td>
            </tr>`

        ;
        tableBody.innerHTML += row;
    });
}


function renderPagination(data) {
    const paginationElement = id("pagination");
    if (!paginationElement || !data.links) return;

    paginationElement.innerHTML = '';

    if (typeof data.links === 'object' && !Array.isArray(data.links)) {
        const linksArray = [
            { label: '«', url: data.links.prev, active: false },
            { label: '1', url: data.links.first, active: true },
            { label: '»', url: data.links.next, active: false }
        ];

        linksArray.forEach(link => {
            if (!link.url) return;

            let btn = document.createElement("button");
            btn.innerHTML = link.label;
            btn.classList.add("p-3");

            if (link.label === '1' && data.meta.current_page === 1) {
                btn.classList.add("active");
                btn.disabled = true;
            }

            btn.addEventListener('click', (e) => {
                e.preventDefault();
                load_marks(link.url);
            });

            paginationElement.appendChild(btn);
        });
    }

    else if (Array.isArray(data.links)) {
        data.links.forEach(link => {
            let btn = document.createElement("button");
            btn.innerHTML = link.label.replace('&laquo;', '«').replace('&raquo;', '»');
            btn.classList.add("p-3");

            if (link.active) {
                btn.classList.add("active");
                btn.disabled = true;
            }

            if (link.url && !link.active) {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    load_marks(link.url);
                });
            } else if (!link.active) {
                btn.disabled = true;
            }

            paginationElement.appendChild(btn);
        });
    }
}
