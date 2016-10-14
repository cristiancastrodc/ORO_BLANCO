$('.datepicker.initial-date').bootstrapMaterialDatePicker({
  weekStart : 1,
  time : false,
  lang : 'es',
  cancelText : 'cerrar',
  switchOnClick : true,
  format : 'YYYY-MM-DD'
})
.on('change', function (e, date) {
  $('.datepicker.final-date').bootstrapMaterialDatePicker('setMinDate', date);
});
$('.datepicker.final-date').bootstrapMaterialDatePicker({
  weekStart : 1,
  time : false,
  lang : 'es',
  cancelText : 'cerrar',
  switchOnClick : true,
  format : 'YYYY-MM-DD'
})
.on('change', function (e, date) {
  $('.datepicker.initial-date').bootstrapMaterialDatePicker('setMaxDate', date);
});
