document.addEventListener('DOMContentLoaded', function() {
  const mainImageContainer = document.querySelector('.main-image');
  const mainImgTextBlock = document.getElementById('main-img');
  const thumbnails = document.querySelectorAll('.thumbnail');
  
  thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('click', function() {

      const computedStyle = window.getComputedStyle(mainImageContainer);
      const currentBg = computedStyle.backgroundImage;
      
      const currentBgUrl = currentBg.startsWith('url') 
        ? currentBg.replace(/^url\(["']?|["']?\)$/g, '') 
        : null;

      mainImageContainer.style.backgroundImage = `url(${this.src})`;
      this.src = currentBgUrl;

      const tempAlt = mainImgTextBlock.alt;
      mainImgTextBlock.alt = this.alt;
      this.alt = tempAlt;
    });
  });
});

const container = document.querySelector('.carousel-container');
                    const prevBtn = document.querySelector('.carousel-prev');
                    const nextBtn = document.querySelector('.carousel-next');
                    let currentIndex = 0;

                    nextBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex + 1) % 8;
                    container.style.transform = `translateX(-${currentIndex * 100}%)`;
                    });

                    prevBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex - 1 + 8) % 8;
                    container.style.transform = `translateX(-${currentIndex * 100}%)`;
                    });