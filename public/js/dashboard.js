$(function () {
    'use strict'
    $('.fc-datepicker').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        minDate: 1,
        firstDay: 1,
        dateFormat: 'dd-mm-yy'
    });

    $('.select2-show-search ').select2();
});
