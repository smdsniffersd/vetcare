const container = document.querySelector('.carousel-container');
const prevBtn = document.querySelector('.carousel-prev');
const nextBtn = document.querySelector('.carousel-next');
let currentIndex = 0;

nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % 4;
    container.style.transform = `translateX(-${currentIndex * 100}%)`;
});

prevBtn.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + 4) % 4;
    container.style.transform = `translateX(-${currentIndex * 100}%)`;
});
document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.li-plan');

    cards.forEach(card => {
        const namePlan = card.querySelector('.price-block-plan');
        const button = card.querySelector('.Enroll-button, .Enroll-button-popular');
        if (button) {
            card.addEventListener('mouseenter', function () {
                card.style.backgroundColor = '#FF9900';
                button.style.backgroundColor = 'black';
                button.style.color = 'white';
                button.style.border = 'black';
                button.style.cursor = 'pointer';
                namePlan.style.backgroundColor = 'black';
                namePlan.style.color = 'white';
            });

            card.addEventListener('mouseleave', function () {
                card.style.backgroundColor = '';
                button.style.backgroundColor = '';
                button.style.color = '';
                button.style.border = 'white';
                button.style.cursor = '';
                namePlan.style.backgroundColor = '#FF9900';
            });
        }
    });
});


