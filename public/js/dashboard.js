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

    let elements = $(document).find('textarea.editor');

    elements.each(function (index, el) {
        new SimpleMDE({element: el, spellChecker: false });
    });
});
