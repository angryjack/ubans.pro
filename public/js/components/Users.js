$('.users-search').on('keyup', function () {
   let query = $(this).val();

    $.ajax({
        method: 'get',
        url: '/users?search=' + query,
        success: function (response) {
            let users = $(response).find(".data-users");
            let pagination = $(response).find("#dataTable-table");
            $('.data-users').html(users[0].innerHTML);
            let paginationContent = pagination[0] ? pagination[0].innerHTML : '';
            $('#dataTable-table').html(paginationContent);
        }
    });
});
