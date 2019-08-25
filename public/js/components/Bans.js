$('.bans-search').on('keyup', function () {
   let query = $(this).val();

    $.ajax({
        method: 'get',
        url: '/bans?search=' + query,
        success: function (response) {
            let bans = $(response).find(".data-bans");
            let pagination = $(response).find("#dataTable-table");
            $('.data-bans').html(bans[0].innerHTML);
            let paginationContent = pagination[0] ? pagination[0].innerHTML : '';
            $('#dataTable-table').html(paginationContent);
        }
    });
});
