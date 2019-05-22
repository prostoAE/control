$(document).ready(function () {
  toogleClassMenu();
  hideLoader();
  setFilterFromStorage();
  getWorkDate();
  runPicker();
});

function runPicker() {
  $('#from').datepicker({
    format : 	'yyyy-mm-dd',
    calendarWeeks : true,
    todayHighlight : true,
    weekStart : 1
  });

  $('#to').datepicker({
    format : 	'yyyy-mm-dd',
    calendarWeeks : true,
    todayHighlight : true,
    weekStart : 1
  });
}

/*Смена класса меню*/
function toogleClassMenu() {
  var menuButton = $('.toogle');
  var menu = $('.menu');
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
  var tarifModal = $('.modalTarif');
  var string = $(this).parent().parent();
  var cost = string.find('td#cost').text();
  var option = $('#newCost');
  var formButton = $('.tarif-form__button');
  var periodFrom = dateFormated(string.find("td.dateFrom").text());
  var periodTo = dateFormated(string.find("td.dateTo").text());

  periodFrom = new Date(periodFrom);
  periodTo = new Date(periodTo);

  if(checkWorkPeriod(periodFrom, periodTo) === true) {
    alert("Период обработки данных закрыт администратором!!");
    return false;
  }

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
$(".modalTarif--close").on('click', hideTarifModal);

function hideTarifModal() {
  var tarifModal = $('.modalTarif');
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

  $.ajax({
    type: 'post',
    url: 'ajax/export-excel',
    data: '',
    beforeSend: function() {
      showLoader();
    },
    success: function (responce) {
      document.location.href = 'ajax/export-excel';
    },
    complete: function() {
      hideLoader();
    }
  });
});

/* Запись значений фильтра в сессию */
$(".filter-btn").on("click", function () {
  var data = $(".filter-form").serializeArray();
  var formData = JSON.stringify(data);
  sessionStorage.setItem("filter", formData);
});

/* Установка фильтра из сессии */
function setFilterFromStorage() {
  var stor = sessionStorage.getItem("filter");

  if(stor) {
    var arr = JSON.parse(stor);
    var data = {};

    for (var i = 0; i < arr.length; i++) {
      data[arr[i]['name']] = arr[i]['value'];
    }

    $("#buyer").val(data['buyer']);
    $("#group").val(data['group']);
    $("#from").val(data['date-from']);
    $("#to").val(data['date-to']);
    $("#frs").val(data['supplier']);
    $("#article").val(data['article']);
  }
}

/* Сброс фильтров */
$(".reset-btn").on("click", function () {
  sessionStorage.removeItem("filter");
});

/* LogOut */
$("#logOut").on('click', function (e) {
  e.preventDefault();

  $.ajax({
    type: 'post',
    url: 'ajax/logout',
    dataType: 'html',
    complete: function () {
      location.reload();
    }
  });
});

/* Установка года агримента */
$("#agrYearBtn").on("click", function (e) {
  e.preventDefault();

  var data = $("#agrYearForm").serialize();

  $.ajax({
    type: 'post',
    url: 'ajax/agreement-update',
    data: data,
    dataType: 'html',
    complete: function () {
      alert('Год изменен!');
    }
  });
});

/* Обновление таблицы CCA */
$("#ccaUpdateBtn").on("click", function (e) {
  e.preventDefault();

  var data = $("#ccaUpdateForm").serialize();

  $.ajax({
    type: 'post',
    url: 'ajax/cca-update',
    data: data,
    dataType: 'html',
    beforeSend: function() {
      showLoader();
    },
    complete: function() {
      hideLoader();
      alert('Обновление таблицы CCA завершено!');
    }
  });
});

/* Обновление таблицы anee_service */
$("#serviceUpdateBtn").on("click", function (e) {
  e.preventDefault();

  var data = $("#serviceUpdateForm").serialize();

  $.ajax({
    type: 'post',
    url: 'ajax/service-update',
    data: data,
    dataType: 'html',
    beforeSend: function() {
      showLoader();
    },
    complete: function() {
      hideLoader();
      alert('Обновление таблицы anee_service завершено!');
    }
  });
});

/* Загрузка данных из СУП */
$("#supLoadBtn").on("click", function (e) {
  e.preventDefault();

  var data = $("#supLoadForm").serialize();

  $.ajax({
    type: 'post',
    url: 'ajax/sup-load',
    data: data,
    dataType: 'html',
    beforeSend: function() {
      showLoader();
    },
    complete: function() {
      hideLoader();
      alert('Загрузка данных из СУП завершена!');
    }
  });
});

/* Удаление пользователя */
$(".delUser").on("click", function (e) {
  e.preventDefault();

  var id = $(this).attr('data-id');

  $.ajax({
    type: 'post',
    url: 'ajax/delete-user',
    data: {user : id},
    dataType: 'html',
    complete: function() {
      location.reload();
    }
  });

});

/* Добавление пользователя */
$("#addUserBtn").on("click", function (e) {
  e.preventDefault();

  var arr = $("#addUserForm").serializeArray();
  var formData = JSON.stringify(arr);

  $.ajax({
    type: 'post',
    url: 'ajax/add-user',
    data: {data : formData},
    dataType: 'html',
    complete: function() {
      location.reload();
    }
  });

});

/* Получение преода обработки данных СУП */
function getWorkDate() {

  $.ajax({
    type: 'post',
    url: 'ajax/work-period',
    dataType: 'text',
    success: function(data) {
      sessionStorage.setItem("period", data);
    }
  });

}

/* Установка периода обработки данных */
$("#setPeriod").on("click", function (e) {
  e.preventDefault();

  var data = $("#setPeriodForm").serialize();
  // var formData = JSON.stringify(arr);

  $.ajax({
    type: 'post',
    url: 'ajax/set-period',
    data: data,
    dataType: 'html',
    complete: function() {
      location.reload();
    }
  });

});

/* Проверка периода обработки данных */
function checkWorkPeriod(dateFrom, dateTo) {
  getWorkDate();

  var data = sessionStorage.getItem("period");
  var arr = JSON.parse(data);
  var workFrom = new Date(arr[0]['date_from']);
  var workTo = new Date(arr[0]['date_to']);

  if(dateFrom < workFrom || dateTo > workTo) {
    return true;
  }

}

/* Отображение текущего состояния установленых рабочих дней */
$("#v-pills-profile-tab").on("click", function () {
  var data = sessionStorage.getItem("period");
  var arr = JSON.parse(data);
  var workFrom = dateFormat(arr[0]['date_from']);
  var workTo = dateFormat(arr[0]['date_to']);

  $(".setting-block__info span").text(workFrom + ' - ' + workTo);
});

/* Преобразование формата даты в dd.mm.yyyy */
function dateFormat(date) {
  var dateAr = date.split('-');
  var newDate = dateAr[2] + '.' + dateAr[1] + '.' + dateAr[0];
  return newDate;
}

/* Преобразование формата даты в yyyy-mm-dd */
function dateFormated(date) {
  var dateAr = date.split('.');
  var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];
  return newDate;
}

/* Вывод кнопки редактирования таблицы из контекстного меню */
$("table").contextmenu(function (e) {
  e.preventDefault();

  var x = e.pageX;
  var y = e.pageY;
  var btn = $(".editTableBtn");

  btn.css("left", x);
  btn.css("top", y);
  btn.show();

  showCheckboxList();
});

/* Скрытие кнопки редактирования таблицы */
$(".editTableBtn").on("click", function () {
  $(".editTableBtn").hide();
});

/* заполнение перечня столбцов в филтре */
function showCheckboxList() {
  var data = $("table th[data-colIndex]");
  var block = $(".control-block");
  var out = '';

  for (var i = 0; i < data.length; i++) {
    out += '<div class="control-block__wrapper">';
    out += '<input type="checkbox" id="colNum_' + i + '" checked>';
    out += '<label for="colNum_' + i + '">' + data[i].textContent + ' </label>';
    out += '</div>';
  }

  block.html(out);
  inputsMark();
}

function inputsMark() {
  var sstrFilter = JSON.parse(sessionStorage.getItem("colFilter"));
  if(sstrFilter.length > 0) {
    for (var i = 0; i < sstrFilter.length; i++) {
      var inp = $("#" + sstrFilter[i]['id']);
      inp.prop("checked", sstrFilter[i]['value']);
      if(inp.prop("checked") === false) {
        hideColumn(i);
      } else {
        showColumn(i);
      }
    }
  }
}

/* Управление отображение/скрытием столбцов таблицы */
$(".control-block").on("change", "input", function () {
  var status = $(this).prop('checked');
  var ind = $(this).attr("id").split("_");
  var colIndex = ind[1];

  if(status === false) {
    hideColumn(colIndex);
  } else {
    showColumn(colIndex);
  }
});

/* скрыть столбец таблицы */
function hideColumn(index) {
  var data = $("table th[data-colIndex=" + index + "],td[data-colIndex=" + index + "]");
  data.each(function () {
    $(this).css("display", "none");
  });
}

/* отобразить столбец таблицы */
function showColumn(index) {
  var data = $("table th[data-colIndex=" + index + "],td[data-colIndex=" + index + "]");
  data.each(function() {
    $(this).css("display", "table-cell");
  });
}

/* Созранение фильтра столбцов таблицы */
$("#colFilterSave").on("click", function (e) {
  e.preventDefault();

  var inputs = $(".control-block input");
  var sessionData = [];

  for (var i = 0; i < inputs.length; i++) {
    sessionData.push({ id: $(inputs[i]).attr("id"), value: $(inputs[i]).prop('checked') });
  }

  sessionStorage.setItem("colFilter", JSON.stringify(sessionData));

  $.ajax({
    type: 'post',
    url: 'ajax/col-filter',
    data: {filter : JSON.stringify(sessionData)},
    dataType: 'html',
    success: function(response) {
      console.log(response);
    }
  });

  $('#exampleModalCenter').modal('hide');
});
