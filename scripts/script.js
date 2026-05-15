document.addEventListener('DOMContentLoaded', function() {
  const mainImg = document.getElementById('main-img');
  const thumbnails = document.querySelectorAll('.thumbnail');
  
  thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('click', function() {
      const tempSrc = mainImg.src;
      const tempAlt = mainImg.alt;
      
      mainImg.src = this.src;
      mainImg.alt = this.alt;
      
      this.src = tempSrc;
      this.alt = tempAlt;
    });
  });
});