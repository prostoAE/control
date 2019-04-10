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

// $('.edit-cost').on('click', function (e) {
//   e.preventDefault();
//
//   var edit = $(this).parent().text();
//   console.log(edit);
// });

