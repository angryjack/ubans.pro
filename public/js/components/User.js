var User = {
    generateAuthKey: function () {
        var randomKey = Math.random().toString(36).substr(2) + '_' + Math.random().toString(36).substr(2);
        var $authInput = $('input[name="auth_key"]');
        var prepentUrl = $authInput.attr('data-url');
        $authInput.val(prepentUrl + randomKey);
        $authInput.val(randomKey);
    }
}

$('.refresh-key').on('click', function () {
    User.generateAuthKey();
});
