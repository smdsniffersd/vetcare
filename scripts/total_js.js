/* dropdownMenu */
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (menuToggle && dropdownMenu) {
        menuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
            menuToggle.style.display = 'none';
        });

        document.addEventListener('click', function () {
            dropdownMenu.classList.remove('show');
            menuToggle.style.display = 'block';
        });

        dropdownMenu.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    }
});


/* progress-wrap */
document.addEventListener('DOMContentLoaded', () => {
    const progressWrap = document.querySelector('.progress-wrap');
    const progressPath = document.querySelector('.progress-circle path');

    if (progressWrap && progressPath) {
        const pathLength = progressPath.getTotalLength();

        progressPath.style.strokeDasharray = pathLength;
        progressPath.style.strokeDashoffset = pathLength;

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY || window.pageYOffset;
            const windowHeight = window.innerHeight;
            const docHeight = document.documentElement.scrollHeight;
            const scrollPercent = scrollY / (docHeight - windowHeight);
            const offset = pathLength - (scrollPercent * pathLength);

            progressPath.style.strokeDashoffset = offset;

            if (scrollY > 100) {
                progressWrap.classList.add('active-progress');
            } else {
                progressWrap.classList.remove('active-progress');
            }
        });

        progressWrap.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});


/* carousel */
document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.carousel-container');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');

    if (container && prevBtn && nextBtn) {
        let currentIndex = 0;

        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % 4;
            container.style.transform = `translateX(-${currentIndex * 100}%)`;
        });

        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + 4) % 4;
            container.style.transform = `translateX(-${currentIndex * 100}%)`;
        });
    } else {
        console.log('Элементы карусели не найдены (это нормально для этой страницы)');
    }
});

/* Chat */
document.addEventListener('DOMContentLoaded', function () {
    const chatButton = document.getElementById('chat-button');
    const chatWindow = document.getElementById('chat-window');
    const closeChat = document.getElementById('close-chat');
    const userInput = document.getElementById('user-input');
    const sendButton = document.getElementById('send-button');
    const chatBody = document.getElementById('chat-body');

    if (chatButton && chatWindow && closeChat && userInput && sendButton && chatBody) {
        chatButton.addEventListener('click', function () {
            chatWindow.style.display = chatWindow.style.display === 'flex' ? 'none' : 'flex';
        });

        closeChat.addEventListener('click', function () {
            chatWindow.style.display = 'none';
        });

        function sendMessage() {
            const message = userInput.value.trim();
            if (message) {
                const userMessage = document.createElement('div');
                userMessage.className = 'message user';
                userMessage.textContent = message;
                chatBody.appendChild(userMessage);
                userInput.value = '';

                chatBody.scrollTop = chatBody.scrollHeight;

                setTimeout(() => {
                    const operatorMessage = document.createElement('div');
                    operatorMessage.className = 'message operator';
                    operatorMessage.textContent = 'Thanks for the message! We will respond to you as soon as possible.';
                    chatBody.appendChild(operatorMessage);
                    chatBody.scrollTop = chatBody.scrollHeight;
                }, 1000);
            }
        }

        sendButton.addEventListener('click', sendMessage);
        userInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') sendMessage();
        });
    }
});

/* Login */
document.addEventListener('DOMContentLoaded', function () {
    const loginBtn = document.getElementById('loginBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const loginOverlay = document.getElementById('loginOverlay');
    const loginForm = document.querySelector('#loginOverlay form');

    if (loginBtn && cancelBtn && loginOverlay && loginForm) {
        loginBtn.addEventListener('click', function () {
            if (window.userLoggedIn) {
                window.location.href = './user_account.php';
            } else {
                loginOverlay.style.display = 'flex';
                console.log('11');
            }
        });

        cancelBtn.addEventListener('click', function () {
            loginOverlay.style.display = 'none';
        });

        loginOverlay.addEventListener('click', function (e) {
            if (e.target === loginOverlay) {
                loginOverlay.style.display = 'none';
            }
        });

        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(loginForm);

            console.log('Отправка данных...');

            fetch('php_components/authorization.php', {
                method: 'POST',
                credentials: 'same-origin',
                body: formData
            })
                .then(response => {
                    console.log('Status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Ответ сервера:', data);
                    try {
                            switch(Number(data['auth_role'])){
                                case 1: window.location.href = "adminpanel.php";
                                break;
                                case 2: window.location.href = "doctorpanel.php";
                                break;
                                default: window.location.href = "user_account.php";
                            }
                    } catch (e) {
                        console.error('Не удалось распарсить JSON:', e);
                        alert('Ошибка: сервер вернул не JSON. Смотрите консоль.');
                    }
                })
                .catch(error => {
                    console.error('Ошибка fetch:', error);
                    alert('Произошла ошибка при входе');
                });
        });
    }
});

/* Contact Form - с проверкой существования */
document.addEventListener('DOMContentLoaded', function () {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const feedFormData = new FormData(contactForm);
            fetch('php_components/feedback.php', {
                method: 'POST',
                credentials: 'same-origin',
                body: feedFormData
            })
                .then(response => {
                    console.log('Status', response.status);
                    return response.text();
                })
                .then(text => {
                    console.log('Raw response:', text);
                    try {
                        const data = JSON.parse(text);
                        if (data.success) {
                            const overlay = document.getElementById('overlayYourMessageSended');
                            if (overlay) overlay.style.display = 'block';
                            contactForm.reset();
                        } else {
                            alert(data.message);
                        }
                    } catch (e) {
                        console.error('Не удалось распарсить JSON:', e);
                        alert('Ошибка: сервер вернул не JSON. Смотрите консоль.');
                    }
                })
                .catch(error => {
                    console.error('Ошибка fetch:', error);
                    alert('Произошла ошибка при входе');
                });
        });
    }
});

function closeModal(button) {
    const modal = button.parentElement?.parentElement;
    if (modal) modal.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    const appoinmentForm = document.getElementById('bookForm');

    if (appoinmentForm) {

        appoinmentForm.addEventListener('submit', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const selectedTime = document.getElementById('selectedTime');
            const selectedDate = document.getElementById('selectedDate');
            if ((selectedTime.value == '') || ((selectedDate.value == ''))) {
                const NullDateTime = document.getElementById('NullDateTime');
                NullDateTime.style.display = 'block';
                setTimeout(() => {
                    NullDateTime.style.display = 'none';
                }, 3000);
                return;
            }
            const appForm = new FormData(appoinmentForm);
            for (let pair of appForm.entries()) {
                console.log('  ', pair[0] + ':', pair[1]);
            }

            fetch('php_components/appoinment.php', {
                method: 'POST',
                body: appForm,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    console.log('Status', response.status);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    loadNotification();
                    console.log('Response', data);
                    if (data.success) {
                        appoinmentForm.reset();
                        const selectedTime = document.getElementById('selectedTime');
                        const selectedDate = document.getElementById('selectedDate');
                        if (selectedTime) selectedTime.value = '';
                        if (selectedDate) selectedDate.value = '';

                        const modalOverlay = document.getElementById("modalOverlay");
                        if (modalOverlay) {
                            modalOverlay.style.display = "flex";
                            document.body.style.overflow = "hidden";
                        }
                    } else {
                        alert(data.message || 'Произошла ошибка при отправке');
                    }
                })
                .catch(error => {
                    console.error('Ошибка fetch:', error);
                    alert('Произошла ошибка при отправке: ' + error.message);
                });
        });

        console.log(' Обработчик формы успешно привязан!');
    } else {
        console.error(' Форма с id="bookForm" не найдена!');
    }
});

function timeBooking(elem) {
    console.log('timeBooking');
    const calendarTimeUl = document.getElementById('calendarTimeUl');
    if (!calendarTimeUl) return;

    const timeElements = calendarTimeUl.querySelectorAll('.calendar-time-li');
    const inputTimeForm = document.getElementById('selectedTime');

    timeElements.forEach(liElement => {
        liElement.style.border = '1px solid #EBEBEB';
        liElement.style.backgroundColor = '#FFFFFF';
        liElement.style.color = '#1B1B1B';
    });

    if (inputTimeForm) {
        inputTimeForm.value = elem.dataset.time;
    }

    elem.style.backgroundColor = 'rgba(255, 153, 0, 0.12)';
    elem.style.border = '1px solid rgba(255, 153, 0, 1)';
    elem.style.color = 'rgba(255, 153, 0, 1)';
}

function setTimeToDay(data) {
    const TimeUL = document.getElementById('calendarTimeUl');
    if (!TimeUL) return;

    const TimeLiAll = TimeUL.querySelectorAll('.calendar-time-li');
    TimeLiAll.forEach(element => {
        if (data && data.includes(element.dataset.time)) {
            element.style.display = 'none';
        } else {
            element.style.display = 'flex';
        }
    });
}
function selectDay(elem) {
    console.log(elem.dataset.fullDate);
    const selectsDays = document.querySelectorAll('.calendar-day ');
    const inputDateForm = document.getElementById('selectedDate');

    if (inputDateForm) {
        inputDateForm.value = elem.dataset.fullDate;
    }

    selectsDays.forEach(element => {
        element.style.removeProperty('background-color');
        element.style.removeProperty('color');
    });
    fetch('./php_components/calendarComp.php', {
        method: 'POST',
        headers: {
            'Content-type': 'application/json'
        },
        body: JSON.stringify({
            date: elem.dataset.fullDate
        })
    })
        .then(response => {
            console.log('Status', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Ответ сервера', data);
            setTimeToDay(data.book_times);
            if (data.success) {
                console.log('Дата успешно отправлена');
                elem.style.backgroundColor = 'rgba(27, 27, 27, 1)';
                elem.style.color = '#FFFFFF';
            }
        })
        .catch(error => {
            console.error('Ошибка отправки:', error);
        });
}

function renderNotifications(appointments) {

    const containUL = document.getElementById('notificationUl');
    let html = '';
    if (!containUL) return;
    appointments.forEach(apt => {
        html += `<li class="notificationLi"><span class="notificationServiceSpan">${apt.specific_service}</span><span class="notificationDateTime">${apt.date} </span><span class="notificationDateTime"> ${apt.time}</span>
        </li>`
    })
    containUL.innerHTML = html;
}

function clearNotifications() {
    const containUL = document.getElementById('notificationUl');
    if (containUL) containUL.innerHTML = '';
}

function loadNotification() {
    fetch('./php_components/notificationAppoinment.php', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(response => {
        return response.json();
    }).then(data => {
        if (data.success && data.data && data.data.length > 0) {
            renderNotifications(data.data);
            const notification = document.getElementById('notification');
            notification.style.display = 'flex';
        } else {
            clearNotifications();
        }
    })
}
document.addEventListener('DOMContentLoaded', function () {
    loadNotification();
});
let rotate = 0;

function checkNotifications(thiselem) {
    const elem = document.getElementById('notificationUl');
    if (rotate === 0) {
        elem.style.display = 'flex';
        elem.style.transform = 'translateY(0)';
        elem.style.opacity = '1';

        rotate += 360;
    } else {
        elem.style.display = 'none';

        rotate -= 360;
    }

    thiselem.style.transform = `rotateX(${rotate}deg)`;
}
try {
    const notification = document.getElementById('notification');
    notification.style.position = 'fixed';
    notification.style.bottom = '10%';
    notification.style.right = '1%';
}catch(e){
    console.log(e);
}



function getInfoPet(elem) {
    const personSpansDiv = document.getElementById('personSpansDiv');
    if (!personSpansDiv) {
        console.error('Element personSpansDiv not found');
        return;
    }
    personSpansDiv.style.display = 'flex';

    fetch('./user_account.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ data: elem.dataset.petId, action: 'getInfoPet' })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Response:', data);

            if (data.success) {
                const petHaventInfo = document.getElementById('petHaventInfo');
                const petLasvisit = document.getElementById('petLasvisit');
                const petVaccinations = document.getElementById('petVaccinations');
                const petTratments = document.getElementById('petTratments');
                const petTestResults = document.getElementById('petTestResults');
                const petPrescribed = document.getElementById('petPrescribed');
                if (!petLasvisit || !petVaccinations || !petTratments || !petTestResults || !petPrescribed || !personSpansDiv || !petHaventInfo) {
                    console.log('Can`t search element`s in DOOM')
                    return;
                }
                personSpansDiv.style.display = 'flex';
                petHaventInfo.style.display = 'none';
                petLasvisit.textContent = `Las visit: ${data.data['last_visit']}`;
                petVaccinations.textContent = `Vaccinations: ${data.data['vaccinations']}`;
                petVaccinationPreparations.textContent = `Vaccination preparations: ${data.data['vaccination_preparations']}`;
                petTratments.textContent = `Parasite treatments: ${data.data['parasite_treatments']}`;
                petTestResults.textContent = `Tests and results: ${data.data['tests_and_results']}`;
            } else {
                if (!data.data || data.data === null) {
                    personSpansDiv.style.display = 'none';
                    petHaventInfo.style.display = 'block';
                    petHaventInfo.textContent = 'Pet haven`t Information';


                } else {
                    console.error('Error:', data.message);
                }

            }
        })
        .catch(error => console.error('Fetch error:', error));
}