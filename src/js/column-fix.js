$("#sup-report-table th i").on("click", function (e) {
  e.preventDefault();

  var index = parseInt($(this).parent().attr("data-colIndex"));
  var lockInd = $(this).attr("data-lock");

  if(lockInd == 1) {
    unficColumn(index);
    $(this).attr("data-lock", 0);
    $(this).css("color", "#cbcbcb");
  } else {
    ficColumn(index);
    $(this).attr("data-lock", 1);
    $(this).css("color", "red");
  }

});

/* Закрепление столбцов таблицы */
function ficColumn(index) {
  var margLeft = parseInt($(".table-box").css("margin-left"));
  var th = $("th[data-colIndex = " + index + "]");
  var td = $("td[data-colIndex = " + index + "]");

  th.each(function () {
    var thOffsetX = $(this).offset().left;

    $(this).css({
      "position" : "sticky",
      "z-index" : 1,
      "left" : thOffsetX - margLeft
    });
  });

  td.each(function () {
    var tdOffsetX = $(this).offset().left;

    $(this).css({
      "position" : "sticky",
      "background" : "#fff",
      "left" : tdOffsetX - margLeft
    });
  });
}

/* Открепление столбцов таблицы */
function unficColumn(index) {
  var th = $("th[data-colIndex = " + index + "]");
  var td = $("td[data-colIndex = " + index + "]");

  th.each(function () {
    var thOffsetX = $(this).offset().left;

    $(this).css({
      "position" : "relative",
      "z-index" : 1,
      "top" : 0,
      "left" : thOffsetX - thOffsetX
    });

    $(this).css({
      "position" : "sticky",
      "top" : 0,
      "left" : $(this).offset().left
    });
  });

  td.each(function () {
    var tdOffsetX = $(this).offset().left;

    $(this).css({
      "position" : "relative",
      "background" : "#fff",
      "left" : tdOffsetX - tdOffsetX
    });
  });
}