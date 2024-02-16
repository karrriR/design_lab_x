const buttonOpen = document.querySelector('.button-open');
const dropdownMenu = document.querySelector('.dropdown-menu');
const overlay = document.querySelector('.overlay');
const closeButton = document.querySelectorAll('.dropdown-menu_button, .overlay');

buttonOpen.addEventListener('click', function() {
  dropdownMenu.classList.toggle('open');
  overlay.classList.toggle('active');
});

closeButton.forEach(function(element) {
    element.addEventListener('click', function() {
      dropdownMenu.classList.remove('open');
      overlay.classList.remove('active');
    });
});