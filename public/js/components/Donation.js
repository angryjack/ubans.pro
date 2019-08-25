$('.make-donation').on('click', function (e) {
    e.preventDefault();
    let title = $('input[name="title"]').val();
    let message = $('input[name="message"]').val();
    let amount = $('input[name="amount"]').val();

    $.ajax({
        method: 'post',
        url: $('form').attr('action'),
        data: {
            amount: amount,
            title: title,
            message: message,
        },
        success: function (response) {
            window.location.href = response.url;
        },
        error: function () {
            window.location.reload();
        }
    });
});
