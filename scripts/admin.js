function drawTable(data) {
    if (data.success) {
        console.log(data);
        const mainOverlay = document.getElementById('mainOverlay');
        if (!mainOverlay) {
            console.error('Элемент mainOverlay не найден');
            return;
        }
        mainOverlay.style.display = 'block';

        let html = '<table border="1">';

        html += `<thead><tr>`;

        for (let key in data.data[0]) {
            if (data['table_name'] === 'users' && key === 'pet_id') {
                html += `<th>Количество питомцев</th>`;
            } else {
                html += `<th>${key}</th>`;
            }
        }

        html += `<th>Действия</th>`;
        html += `</tr></thead>`;

        html += `<tbody>`;
        data.data.forEach(element => {
            html += `<tr data-id="${element['id']}">`;

            for (let key in element) {

                if (data['table_name'] === 'users' && key === 'pet_id') {

                    const petCount = element[key] || 0;
                    const pawIcon = '🐾'.repeat(Math.min(petCount, 3));
                } else {
                    html += `<td>${element[key] ?? ''}</td>`;
                }
            }

            html += `<td>
                    <button onclick="showUserPets(${element['id']})">🐾</button>
                    <button onclick="editRow(this, '${data['table_name']}')">✏️</button>
                    <button onclick="deleteRow(this, '${data['table_name']}')">🗑️</button>
                </td>`;

            html += `</tr>`;
        });
        html += `</tbody>`;
        html += `</table>`;

        mainOverlay.innerHTML = html;
    } else {
        console.log('Error', data.message);
    }
}

function getInfo(element) {

    const table = element.textContent.trim();
    fetch('./php_components/adminlogic.php', {
        method: 'POST',
        body: JSON.stringify({ value: table, action: 'getUserInfo' }),
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(responce => {

        return responce.json();

    }).then(data => {
        drawTable(data);
    }).catch(error => console.error('Fetch error', error));

}
function overlayGetInfoPets(data) {
    const overlayGetInfoPets = document.getElementById('overlayGetInfoPets');
    const overlayGetInfoPetsFirst = document.getElementById('overlayGetInfoPetsFirst');
    overlayGetInfoPets.style.display = 'block';
    let html = '';
    data.pets.forEach(element => {

        html += `<div class="overlayGetInfoPetsDiv">`;
        html += `<div><span class="overlayGetInfoPetsSpan" id="overlayGetInfoPetsSpan">Name: ${element['name']} </span>`;
        html += `<span class="overlayGetInfoPetsSpan" id="overlayGetInfoPetsSpan">View: ${element['view']} </span>`;
        html += `<span class="overlayGetInfoPetsSpan" id="overlayGetInfoPetsSpan">Breed: ${element['Breed']} </span></div>`;
        html += `<div><span class="overlayGetInfoPetsSpan" id="overlayGetInfoPetsSpan">Age: ${element['Age']} </span>`;
        html += `<span class="overlayGetInfoPetsSpan" id="overlayGetInfoPetsSpan">Weight: ${element['weight']} </span>`;
        html += `<span class="overlayGetInfoPetsSpan" id="overlayGetInfoPetsSpan">Spec.M: ${element['special_marks']} </span>`;
        html += `</div></div>`
        html += `</div></div>`
        html += `<div class="overlayGetInfoPetsX" id="overlayGetInfoPetsX" onclick="closeOverlay()">✖</div>`;
        html += `<div class="overlayGetInfoPetsNewAddPet" id="overlayGetInfoPetsAddPet" onclick="overlayGetInfoPetsAddPet(${element['owner_id']})">➕</div>`;


    })
    overlayGetInfoPets.innerHTML = html;

}
function showUserPets(id, a = true) {

    if (!id) {
        console.log('Not found user_id');
        return;
    }

    fetch('./user_account.php', {
        method: 'POST',
        body: JSON.stringify({ action: 'getUsersPets', userID: id, flag: true }),
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }


    }).then(response => {
        return response.json();
    }).then(data => {

        if (data.success === false) {
            if (data.message === 'Pets has not info') {
                overlayGetInfoPets(data);
            }
            else {
                const overlayGetInfoPetshtml = document.getElementById('overlayGetInfoPets');
                let html = '';
                html += `<div class="overlayGetInfoPetsX" id="overlayGetInfoPetsX" onclick="closeOverlay()">✖</div>`;
                html += `</div><div class="overlayGetInfoPetsNewAddPet" id="overlayGetInfoPetsAddPet" onclick="overlayGetInfoPetsAddPet(${id})">➕</div></div>`
                html += `<div class="overlayGetInfoPetsMessage">${data.message}</div>`;
                overlayGetInfoPetshtml.innerHTML = html;
                overlayGetInfoPetshtml.style.display = 'block';
            }


        }
        else {
            overlayGetInfoPets(data);
        }
    })
}
function closeOverlay() {
    const overlayGetInfoPets = document.getElementById('overlayGetInfoPets');
    overlayGetInfoPets.style.display = 'none';
}
function overlayGetInfoPetsAddPet(id) {
    console.log('overlayGetInfoPetsAddPet', id);
    const overlayGetInfoPetsAddPet = document.getElementById('overlayGetInfoPetsAddPetOverlay');
    const owner_id = document.getElementById('owner_id');
    overlayGetInfoPetsAddPet.style.display = 'block';
    if (owner_id) {
        owner_id.value = id;
    } else {
        console.error('Элемент с id="owner_id" не найден');
    }

}

document.addEventListener('DOMContentLoaded', function () {
    const AddPetForm = document.getElementById('overlayGetInfoPetsAddPetOverlayForm');
    const overlayGetInfoPetsAddPetOverlay = document.getElementById('overlayGetInfoPetsAddPetOverlay');
    const overlaySuccessAddPet = document.getElementById('overlaySuccessAddPet');
    if (AddPetForm) {
        AddPetForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const PetForm = new FormData(AddPetForm);
            const jsonData = {};
            PetForm.forEach((value, key) => {
                jsonData[key] = value;
            })
            console.log(jsonData);
            fetch('./php_components/adminlogic.php', {
                method: 'POST',
                body: JSON.stringify(jsonData),
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(responce => {
                return responce.json();
            }).then(data => {
                overlayGetInfoPetsAddPetOverlay.style.display = 'none';
                overlaySuccessAddPet.style.display = 'block';
                overlaySuccessAddPet.textContent = `${data.message}`;
                showUserPets(data['user_id'], true);
                setTimeout(() => {
                    overlaySuccessAddPet.style.display = 'none';
                }, 3000)

            })
        })
    }
})

function deleteUser(elem) {
    const overlayDeleteUserDiv = document.getElementById('overlayDeleteUserDiv');
    const overlayDeleteUser = document.getElementById('overlayDeleteUser');
    const overlayDeleteUserSpan = document.getElementById('overlayDeleteUserSpan');
    if (elem.textContent === 'No') {

        overlayDeleteUser.style.display = 'none';
    } else {
        id = elem.dataset.userid;
        const data = { id: id, action: 'deleteUser' };

        fetch('./php_components/adminlogic.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(responce => {
            console.log(responce.status);
            return responce.json();
        }).then(data => {
            overlayDeleteUserDiv.style.display = 'none';
            overlayDeleteUserSpan.textContent = data.message;
            overlayDeleteUser.style.height = '5vh';
            setTimeout(() => {
                overlayDeleteUserDiv.style.display = 'flex';
                overlayDeleteUser.style.display = 'none';
            }, 3000)

            console.log(data);
        });
    }

}

function deleteUserOverlay(id) {
    const overlayDeleteUserAnswerYes = document.getElementById('overlayDeleteUserAnswerYes');
    const overlayDeleteUser = document.getElementById('overlayDeleteUser');
    overlayDeleteUser.style.display = 'block';
    overlayDeleteUserAnswerYes.dataset.userid = id;

}

function editRow(elem, tableName) {
    const tr = elem.closest('tr');
    const cells = tr.querySelectorAll('td');
    const rowId = tr.dataset.id || cells[0].textContent;

    const editModal = document.getElementById('editModal');
    editModal.style.display = 'block';

    const modalHtml = editRowHtml(tableName, cells, rowId);
    editModal.innerHTML = modalHtml;


    document.getElementById('editRowForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);
        const updatedData = {};

        formData.forEach((value, key) => {
            updatedData[key] = value;
        });
        updatedData.action = 'editRow';
        updatedData.table = tableName;
        updatedData.id = rowId;

        try {
            const response = await fetch('./php_components/adminlogic.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(updatedData)
            });

            const result = await response.json();

            if (result.success) {
                updateRowCells(cells, tableName, updatedData);
                closeModal();
                alert('Запись обновлена');
            } else {
                alert('Ошибка: ' + result.message);
            }
        } catch (error) {
            console.error('Ошибка:', error);
            alert('Ошибка при сохранении');
        }
    });
}

function editRowHtml(tableName, cells, rowId) {
    if (tableName === 'users') {
        return `
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Редактирование пользователя</h2>
                <form id="editRowForm">
                    <label>ID:</label>
                    <input type="text" value="${rowId}" disabled>
                    
                    <label>Имя:</label>
                    <input type="text" name="firstName" value="${cells[1]?.textContent || ''}" required>
                    
                    <label>Фамилия:</label>
                    <input type="text" name="secondName" value="${cells[2]?.textContent || ''}">
                    
                    <label>Email:</label>
                    <input type="email" name="email" value="${cells[3]?.textContent || ''}" required>
                    
                    <label>Телефон:</label>
                    <input type="tel" name="phone" value="${cells[4]?.textContent || ''}">
                    
                    <button type="submit">Сохранить</button>
                    <button type="button" onclick="closeModal()">Отмена</button>
                </form>
            </div>
        `;
    }

    if (tableName === 'personal') {
        return `
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Редактирование сотрудника</h2>
                <form id="editRowForm">
                    <label>ID:</label>
                    <input type="text" value="${rowId}" disabled>
                    
                    <label>Имя:</label>
                    <input type="text" name="name" value="${cells[1]?.textContent || ''}" required>
                    
                    <label>Должность:</label>
                    <input type="text" name="position" value="${cells[2]?.textContent || ''}" required>
                    
                    <label>Телефон:</label>
                    <input type="tel" name="phone" value="${cells[3]?.textContent || ''}">
                    
                    <label>Email:</label>
                    <input type="email" name="email" value="${cells[4]?.textContent || ''}">
                    
                    <button type="submit">Сохранить</button>
                    <button type="button" onclick="closeModal()">Отмена</button>
                </form>
            </div>
        `;
    }

    if (tableName === 'pets') {
        return `
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Редактирование питомца</h2>
                <form id="editRowForm">
                    <label>ID:</label>
                    <input type="text" value="${rowId}" disabled>
                    
                    <label>Кличка:</label>
                    <input type="text" name="name" value="${cells[1]?.textContent || ''}" required>
                    
                    <label>Вид:</label>
                    <select name="type">
                        <option value="cat" ${cells[2]?.textContent === 'cat' ? 'selected' : ''}>Кошка</option>
                        <option value="dog" ${cells[2]?.textContent === 'dog' ? 'selected' : ''}>Собака</option>
                        <option value="other" ${cells[2]?.textContent === 'other' ? 'selected' : ''}>Другое</option>
                    </select>
                    
                    <label>Порода:</label>
                    <input type="text" name="breed" value="${cells[3]?.textContent || ''}">
                    
                    <label>Возраст:</label>
                    <input type="number" name="age" value="${cells[4]?.textContent || ''}">
                    
                    <label>ID владельца:</label>
                    <input type="number" name="owner_id" value="${cells[5]?.textContent || ''}" required>
                    
                    <button type="submit">Сохранить</button>
                    <button type="button" onclick="closeModal()">Отмена</button>
                </form>
            </div>
        `;
    }

    if (tableName === 'appointments') {
        return `
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Редактирование записи</h2>
                <form id="editRowForm">
                    <label>ID:</label>
                    <input type="text" value="${rowId}" disabled>
                    
                    <label>Дата и время:</label>
                    <input type="datetime-local" name="appointment_date" value="${cells[1]?.textContent || ''}" required>
                    
                    <label>ID питомца:</label>
                    <input type="number" name="pet_id" value="${cells[2]?.textContent || ''}" required>
                    
                    <label>ID врача:</label>
                    <input type="number" name="doctor_id" value="${cells[3]?.textContent || ''}" required>
                    
                    <label>Статус:</label>
                    <select name="status">
                        <option value="scheduled" ${cells[4]?.textContent === 'scheduled' ? 'selected' : ''}>Запланирован</option>
                        <option value="completed" ${cells[4]?.textContent === 'completed' ? 'selected' : ''}>Завершён</option>
                        <option value="cancelled" ${cells[4]?.textContent === 'cancelled' ? 'selected' : ''}>Отменён</option>
                    </select>
                    
                    <button type="submit">Сохранить</button>
                    <button type="button" onclick="closeModal()">Отмена</button>
                </form>
            </div>
        `;
    }
    return `
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Редактирование записи</h2>
            <form id="editRowForm">
                <label>ID:</label>
                <input type="text" value="${rowId}" disabled>
                <button type="submit">Сохранить</button>
                <button type="button" onclick="closeModal()">Отмена</button>
            </form>
        </div>
    `;
}

function updateRowCells(cells, tableName, data) {
    if (tableName === 'users') {
        cells[1].textContent = data.firstName;
        cells[2].textContent = data.secondName;
        cells[3].textContent = data.email;
        cells[4].textContent = data.phone;
    }

    if (tableName === 'personal') {
        cells[1].textContent = data.name;
        cells[2].textContent = data.position;
        cells[3].textContent = data.phone;
        cells[4].textContent = data.email;
    }

    if (tableName === 'pets') {
        cells[1].textContent = data.name;
        cells[2].textContent = data.type;
        cells[3].textContent = data.breed;
        cells[4].textContent = data.age;
        cells[5].textContent = data.owner_id;
    }

    if (tableName === 'appointments') {
        cells[1].textContent = data.appointment_date;
        cells[2].textContent = data.pet_id;
        cells[3].textContent = data.doctor_id;
        cells[4].textContent = data.status;
    }
}

function closeModal() {
    const modal = document.getElementById('editModal');
    modal.style.display = 'none';
}

function deleteRow(elem, tableName) {
    if (!confirm(`Удалить запись из "${tableName}"?`)) {
        return;
    }

    const tr = elem.closest('tr');
    const rowId = tr.dataset.id || tr.querySelector('td')?.textContent;

    if (!rowId) {
        alert('ID не найден');
        return;
    }


    console.log('Удаляем ID:', rowId);

    const deleteData = {
        action: 'deleteRow',
        table: tableName,
        column: 'id',
        value: rowId
    };

    console.log('Отправляем данные:', deleteData);

    fetch('./php_components/adminlogic.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(deleteData)
    })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                tr.remove();
                alert('Запись удалена');
            } else {
                alert('Ошибка: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            alert('Ошибка при удалении');
        });
}

function addRow(tableName) {
    const editModal = document.getElementById('editModal');
    if (!editModal) {
        console.error('editModal не найден');
        return;
    }

    editModal.style.display = 'block';
    const modalHtml = addRowHtml(tableName);
    editModal.innerHTML = modalHtml;

    document.getElementById('addRowForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);
        const newData = {};
        formData.forEach((value, key) => {
            newData[key] = value;
        });
        newData.action = 'addRow';
        newData.table = tableName;

        console.log('Отправляем данные:', newData);

        try {
            const response = await fetch('./php_components/adminlogic.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(newData)
            });

            const result = await response.json();

            if (result.success) {
                alert('Запись добавлена');
                closeModal();
                loadTableData(tableName);
            } else {
                alert(' Ошибка: ' + result.message);
            }
        } catch (error) {
            console.error('Ошибка:', error);
            alert('Ошибка при добавлении');
        }
    });
}

function addRowHtml(tableName) {
    if (tableName === 'users') {
        return `
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>➕ Добавление пользователя</h2>
                <form id="addRowForm">
                    <label>Имя:</label>
                    <input type="text" name="firstName" required>
                    
                    <label>Фамилия:</label>
                    <input type="text" name="secondName">
                    
                    <label>Email:</label>
                    <input type="email" name="email" required>
                    
                    <label>Телефон:</label>
                    <input type="tel" name="phone">
                    
                    <label>Пароль:</label>
                    <input type="password" name="password" required>
                    
                    <label>Роль (ID):</label>
                    <input type="number" name="role_id" value="3" required>
                    
                    <button type="submit">Сохранить</button>
                    <button type="button" onclick="closeModal()">Отмена</button>
                </form>
            </div>
        `;
    }

    if (tableName === 'personal') {
        return `
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>➕ Добавление сотрудника</h2>
                <form id="addRowForm">
                    <label>Имя:</label>
                    <input type="text" name="first_name" required>
                    
                    <label>Фамилия:</label>
                    <input type="text" name="second_name" required>
                    
                    <label>Телефон:</label>
                    <input type="tel" name="phone_number">
                    
                    <label>Email:</label>
                    <input type="email" name="email">
                    
                    <label>Профессия (ID):</label>
                    <input type="number" name="profession_id" required>
                    
                    <button type="submit">Сохранить</button>
                    <button type="button" onclick="closeModal()">Отмена</button>
                </form>
            </div>
        `;
    }

    if (tableName === 'pets') {
        return `
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>➕ Добавление питомца</h2>
                <form id="addRowForm">
                    <label>Кличка:</label>
                    <input type="text" name="name" required>
                    
                    <label>Вид:</label>
                    <select name="view">
                        <option value="cat">Кошка</option>
                        <option value="dog">Собака</option>
                        <option value="bird">Птица</option>
                        <option value="other">Другое</option>
                    </select>
                    
                    <label>Порода:</label>
                    <input type="text" name="Breed">
                    
                    <label>Возраст:</label>
                    <input type="number" name="Age">
                    
                    <label>Вес:</label>
                    <input type="text" name="weight">
                    
                    <label>Особые приметы:</label>
                    <textarea name="special_marks"></textarea>
                    
                    <label>ID владельца:</label>
                    <input type="number" name="owner_id" required>
                    
                    <button type="submit">Сохранить</button>
                    <button type="button" onclick="closeModal()">Отмена</button>
                </form>
            </div>
        `;
    }

    if (tableName === 'appointments') {
        return `
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>➕ Добавление записи</h2>
                <form id="addRowForm">
                    <label>Услуга:</label>
                    <input type="text" name="specific_service" required>
                    
                    <label>Тип питомца:</label>
                    <input type="text" name="pet_type">
                    
                    <label>Состояние:</label>
                    <textarea name="specific_condition"></textarea>
                    
                    <label>Дата:</label>
                    <input type="date" name="date" required>
                    
                    <label>Время:</label>
                    <input type="time" name="time" required>
                    
                    <label>ID пользователя:</label>
                    <input type="number" name="user_id" required>
                    
                    <button type="submit">Сохранить</button>
                    <button type="button" onclick="closeModal()">Отмена</button>
                </form>
            </div>
        `;
    }

    return `
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>➕ Добавление записи в ${tableName}</h2>
            <form id="addRowForm">
                <p>Форма для таблицы "${tableName}" в разработке</p>
                <button type="button" onclick="closeModal()">Закрыть</button>
            </form>
        </div>
    `;
}
function loadTableData(tableName) {
    fetch('./php_components/adminlogic.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            action: 'getUserInfo',
            value: tableName
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                drawTable(data);
            } else {
                console.error('Ошибка загрузки:', data.message);
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
        });
}