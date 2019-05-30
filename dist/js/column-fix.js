$("#sup-report-table th i").on("click", function (e) {
  e.preventDefault();

  var index = parseInt($(this).parent().attr("data-colIndex"));
  var lockInd = $(this).attr("data-lock");

  if(lockInd == 1) {
    alert("Столбец уже закреплен!");
  } else {
    ficColumn(index);
    $(this).attr("data-lock", 1);
    $(this).css("color", "red");
  }

});

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