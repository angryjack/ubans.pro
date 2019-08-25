let $profileName = $('input[name="nickname"]');
let $profilePassword = $('input[name="password"]');

$profileName.on('keyup', function () {
    $profileName.removeClass('is-invalid');
    $profileName.siblings('.errors').html('');
});
$profilePassword.on('keyup', function () {
    $profilePassword.removeClass('is-invalid');
    $profilePassword.siblings('.errors').html('');
});

$('.extend-privilege').on('click', function () {
   var $form = $('.server-' + $(this).attr('data-server'));
   var rate = $form.find('select').val();

    $.ajax({
        method: 'post',
        url: '/payment/go/privilege',
        data: {
            rate: rate,
        },
        success: (response) => {
            window.location.href = response.url;
        },
    });
});

$('.do-update').on('click', function () {
    $.ajax({
        method: 'post',
        url: '/profile/update',
        data: {
            nickname: $profileName.val(),
            password: $profilePassword.val()
        },
        success: (response) => {
            window.location.reload();
        },
        error: (response) => {
            if (response.responseJSON.nickname) {
                $profileName.addClass('is-invalid');
                $profileName.siblings('.errors').html(response.responseJSON.nickname)
            }

            if (response.responseJSON.password) {
                $profilePassword.addClass('is-invalid');
                $profilePassword.siblings('.errors').html(response.responseJSON.password)
            }
        }
    });
});
