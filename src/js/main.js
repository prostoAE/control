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

/* Show tarif modal */
$('.edit-cost').on('click', showTarifModal);

function showTarifModal() {
  var tarifModal = $('.modal');
  var string = $(this).parent().parent();
  var cost = string.find('td#cost').text();
  var option = $('#newCost');

  if (cost != 0) {
    option.text(cost);
  } else {
    option.text('');
  }

  tarifModal.fadeIn();
}

/* Hide tarif modal */
$(".modal--close").on('click', hideTarifModal);

function hideTarifModal() {
  var tarifModal = $('.modal');
  tarifModal.fadeOut();
}

