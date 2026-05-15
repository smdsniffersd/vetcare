  function toggleAccordion(button) {
    const dayBlock = button.parentElement;
    const content = dayBlock.querySelector('.accordion-content');
    
    button.classList.toggle('active');
    content.classList.toggle('active');
  }