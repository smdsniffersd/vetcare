document.addEventListener('DOMContentLoaded', function() {
const container = document.querySelector('.carousel-container');
            const prevBtn = document.querySelector('.carousel-prev');
            const nextBtn = document.querySelector('.carousel-next');
            let currentIndex = 0;

            nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % 2;
            container.style.transform = `translateX(-${currentIndex * 100}%)`;
            });

            prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + 2) % 2;
            container.style.transform = `translateX(-${currentIndex * 100}%)`;
            });
    });

/* progress-wrap */
document.addEventListener('DOMContentLoaded', () => {
    const progressWrap = document.querySelector('.progress-wrap');
    const progressPath = document.querySelector('.progress-circle path');
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
});