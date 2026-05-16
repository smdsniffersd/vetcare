function getInfo(element) {

    console.log('in getInfo');
    const table = element.textContent.trim();
    fetch('./php_components/adminlogic.php', {
        method: 'POST',
        body: JSON.stringify({ value: table }),
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(responce => {

        return responce.json();

    }).then(data => {
        if (data.success) {
            console.log(data);
            const mainOverlay = document.getElementById('mainOverlay');
            if (!mainOverlay) {
                console.error('Элемент mainOverlay не найден');
                return;
            }
            mainOverlay.style.display = 'block';
            let html = '';
            html += `<tr>`
            for(let key in data.data[0]){
                html += `<th>${key}</th>`;
            }
            html += `</tr>`;

            data.data.forEach(element =>{
                html += `<tr>`;
                for(let key in element){
                    html += `<td>${element[key]}</td>`;
                }
                html += `</tr>`;
            });
            mainOverlay.innerHTML = html;
        } else {
            console.log('Error', data.message);
        }
    }).catch(error => console.error('Fetch error', error));

}