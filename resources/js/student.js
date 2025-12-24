const id = (e) => document.getElementById(e);

document.addEventListener('DOMContentLoaded', () => {
    async function load_data(url = '/api/marks') {
        const response = await fetch(url);
        const data = await response.json();
        print(data);
        Pagination(data);
    }

    function print(data) {
        const tableBody = id('marks-table');
        const items = data.data;

        tableBody.innerHTML = '';

        items.forEach(item => {
            const row =`
                    <tr>
                        <td>${item.subject ? item.subject.subject_name : '—'}</td>
                        <td>${item['control_type']}</td>
                        <td>${item['date']}</td>
                        <td>${item['value']}</td>
                    </tr>
                            `

            ;
            tableBody.innerHTML += row;
        });
    }

    function Pagination(data) {
        id("pagination").innerHTML = '';

        data.links.forEach(e => {
            let item = document.createElement("button");


            item.innerHTML = e.label;
            item.classList.add("p-3");

            if (e.active) {
                item.style.fontWeight = "bold";
            }

            if (!e.active && e.url !== null) {
                item.classList.add("has-link");
                item.addEventListener('click', (event) => {
                    event.preventDefault();
                    load_data(e.url);
                });
            }

            id("pagination").appendChild(item);
        });
    }

    load_data();
});
