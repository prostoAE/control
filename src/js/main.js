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
  var formButton = $('.tarif-form__button');

  if (cost != 0) {
    option.text(cost);
  } else {
    option.text('');
  }

  formButton.attr('data-id', $(this).attr("data-id"));
  formButton.attr('data-store', $(this).attr("data-store"));

  tarifModal.fadeIn();
}

/* Hide tarif modal */
$(".modal--close").on('click', hideTarifModal);

function hideTarifModal() {
  var tarifModal = $('.modal');
  tarifModal.fadeOut();
}


$(".tarif-form__button").on('click', function (e) {
  e.preventDefault();

  $.ajax({
    type: 'post',
    url: 'ajax/index',
    dataType: 'text',
    data: 'test',
    success:function (response) {
      console.log(response);
      hideTarifModal();
    }
  })

});
