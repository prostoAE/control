$(document).ready(function () {
  toogleClassMenu();
});

/*Смена класса меню*/
function toogleClassMenu() {
  menuButton = $('.toogle');
  menu = $('.menu');
  menuButton.on('click', function() {
    menuButton.toggleClass('active');
    menu.toggleClass('active');
  })
}
