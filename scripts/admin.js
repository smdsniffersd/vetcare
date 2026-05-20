function getInfo(element) {

    const table = element.textContent.trim();
    fetch('./php_components/adminlogic.php', {
        method: 'POST',
        body: JSON.stringify({ value: table, action: 'getInfo' }),
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
            for (let key in data.data[0]) {
                html += `<th>${key}</th>`;
            }
            if (data['tableName'] === 'users') { html += `<th>-</th>` }
            html += `</tr>`;

            data.data.forEach(element => {
                html += `<tr>`;
                for (let key in element) {
                    html += `<td>${element[key]}</td>`;

                }
                if (data['tableName'] === 'users') {
                    html += `<td>
                <button onclick="showUserPets(${element['id']})">🐾 Pets</button>
                <button onclick="editUser(${element['id']})">✏️</button>
                <button onclick="deleteUserOverlay(${element['id']})">🗑️</button>
                </td>`
                }

                html += `</tr>`;
            });
            mainOverlay.innerHTML = html;
        } else {
            console.log('Error', data.message);
        }
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
        const data = { id: id, action: 'deleteUser'};

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
            setTimeout(()=>{
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