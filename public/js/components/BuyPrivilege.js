$(function () {
    $('#payment-privilege').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        labels:
            {
                finish: "Согласиться и оплатить",
                next: "Вперед",
                previous: "Назад",
            },
        titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
        cssClass: 'wizard wizard-style-1',
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex < newIndex) {
                if (currentIndex === 0) {
                    let server = $selectServer.val();
                    let privilege = $selectPrivilege.val();
                    let rate = $selectRate.val();

                    if (server && privilege && rate) {
                        return true;
                    }

                    if (!privilege) {
                        $selectPrivilege.parent().addClass('has-danger');
                    }

                    if (!rate) {
                        $selectRate.parent().addClass('has-danger');
                    }

                    $('a[href="#next"]').parent().addClass('disabled');
                }
                if (currentIndex === 1) {
                    var $email = $('input[name="email"]');
                    var $nickname = $('input[name="nickname"]');
                    window.nickname = $nickname.parsley();
                    window.email = $email.parsley();

                    $email.on('change', () => {
                        window.email.removeError('id-1', {updateClass: true});
                    });

                    $nickname.on('change', () => {
                        window.nickname.removeError('id-1', {updateClass: true});
                    });

                    if (email.isValid() && nickname.isValid()) {
                        return true;
                    } else {
                        email.validate();
                        nickname.validate()
                    }
                }
                // Always allow step back to the previous step even if the current step is not valid.
            } else {
                return true;
            }
        },
        onFinishing: function (event, currentIndex) {
            var server = $selectServer.val();
            var privilege = $selectPrivilege.val();
            var rate = $selectRate.val();
            var nickname = $('input[name="nickname"]').val();
            var email = $('input[name="email"]').val();

            $.ajax({
                method: 'post',
                url: '/payment/redirect',
                data: {
                    server: server,
                    privilege: privilege,
                    rate: rate,
                    nickname: nickname,
                    email: email
                },
                success: (response) => {
                    //window.location.href = response.url;
                },
                error: (response) => {
                    if (response.responseJSON.email) {
                        window.email = $('input[name="email"]').parsley();
                        window.email.addError('id-1', {
                            message: response.responseJSON.email, assert: true, updateClass: true
                        });
                    }

                    if (response.responseJSON.nickname) {
                        window.nickname = $('input[name="nickname"]').parsley();
                        window.nickname.addError('id-1', {
                            message: response.responseJSON.nickname, assert: true, updateClass: true
                        });
                    }

                    $("a[href='#previous']").click();
                }
            });
        },
    });

    var $selectServer = $('select[name="server"]');
    var $selectPrivilege = $('select[name="privilege"]');
    var $selectRate = $('select[name="rate"]');
    var $content = $('.content-body');
    var $rules = $('.rules-body');

    // buy form
    $selectServer.on('select2:select', function (e) {
        let server = $selectServer.val();
        $selectPrivilege.html('');
        $selectRate.html('');
        $selectServer.parent().removeClass('has-danger');
        $('a[href="#next"]').parent().addClass('disabled');

        $.ajax({
            method: 'post',
            url: '/privileges/server/' + server,
            success: function (response) {
                $content.html(response.server.description);
                $rules.html(response.server.rules);
                let options = '<option selected disabled>Выберите услугу</option>';
                response.server.privileges.forEach(function (item, i, arr) {
                    options += '<option value="' + item.id + '">' + item.title + '</option>'
                });
                $selectPrivilege.html(options);
                $selectPrivilege.parent().show();
            }
        });
    });
    $selectPrivilege.on('select2:select', function (e) {
        let privilege = $selectPrivilege.val();
        $selectPrivilege.parent().removeClass('has-danger');
        $('a[href="#next"]').parent().addClass('disabled');

        $.ajax({
            method: 'post',
            url: '/privileges/' + privilege + '/terms',
            success: function (response) {
                $content.html(response.content);
                let options = '<option selected disabled>Выберите срок</option>';
                response.terms.forEach(function (item, i, arr) {
                    let optionTitle = item.term === 0 ?
                        'Навсегда' :
                        (item.term + ' дн.');

                    options += '<option value="' + item.id + '">' + optionTitle + ' - ' + item.price + ' руб.' + '</option>'
                });
                $selectRate.html(options);
                $selectRate.parent().show();
            }
        });
    });
    $selectRate.on('select2:select', function (e) {
        $selectRate.parent().removeClass('has-danger');
        $('a[href="#next"]').parent().removeClass('disabled');
    });

    $('a[href="#next"]').parent().addClass('disabled');

});
