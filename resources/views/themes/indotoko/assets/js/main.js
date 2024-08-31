
$(function () {
  /*=======================
              UI Slider Range JS
  =========================*/
  $("#slider-range").slider({
      range: true,
      min: 0,
      max: 1000000,
      values: [$("#min_price").val(), $("#max_price").val()],
      slide: function (event, ui) {
          $("#amount").val(ui.values[0] + " - " + ui.values[1]);
      }
  });
  $("#amount").val($("#slider-range").slider("values", 0) +
      " - " + $("#slider-range").slider("values", 1));
});