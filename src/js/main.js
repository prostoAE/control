$(document).ready(function () {
  toogleClassMenu();
  hideLoader();
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

/* Показать / скрыть прелоадер */
function showLoader() {
  $(".loader-bg").fadeIn(500);
}

function hideLoader() {
  $(".loader-bg").fadeOut(500);
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

/* Изменение тарифа */
$(".tarif-form__button").on('click', function (e) {
  e.preventDefault();

  var data = {};
  var cell = '';

  data['id'] = $(this).attr('data-id');
  data['store'] = $(this).attr('data-store');
  data['tarif'] = $('.tarif-form__select').val();

  $.ajax({
    type: 'post',
    url: 'ajax/tarif-confirm',
    dataType: 'json',
    data: data,
    complete:function () {
      cell = updateCell(data['id'], data['store'], data['tarif']);
      hideTarifModal();
    }
  });
});

/* Обновление тарифов в таблицу промо после AJAX запроса */
function updateCell(id, store, tarif) {
  var oldTarif;
  var newTarif;
  var path = $('.edit-cost[data-id='+id+'][data-store='+store+']').parent();
  var regExp = /[^\/]*/;

  oldTarif = path.text().match(regExp);
  path.text("");
  newTarif = path.text(oldTarif+'/'+tarif);

  return newTarif;
}

/* Export to Excel */
$('.excel-btn').on('click', function (e) {
  e.preventDefault();

  showLoader();

  $.ajax({
    type: 'post',
    url: 'ajax/export-excel',
    data: '',
    beforeSend: function() {
      showLoader();
    },
    success: function (responce) {
      console.log(responce);
      document.location.href = 'ajax/export-excel';
    },
    complete: function() {
      hideLoader();
    }
  });
});