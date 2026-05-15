const sumbitInfo = document.getElementById("sumbit");
const modalOverlay = document.getElementById("modalOverlay");
const closeModals = document.getElementById("closeModalBtn");
const bookForm = document.getElementById("bookForm");

// bookForm.addEventListener("submit", (e) => {
//     e.preventDefault();
//     modalOverlay.style.display = "flex";
//     document.body.style.overflow = "hidden";
// });

closeModals.addEventListener("click", () => {
    modalOverlay.style.display = "none";
    document.body.style.overflow = "auto";
});
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