Здравствуйте <i>{{ $user->nickname }}</i>.
<br>
Спасибо за совершенную покупку! Каждая покупка - это вклад в дальнейшее развитие проекта.
<br><br>
Вот ваши данные:
<p>Ник: {{ $user->steamid }}</p>
<p>Пароль: setinfo _pw {{ substr($user->auth_key, 0, 8) }}</p>
<p>Уникальная ссылка для входа в личный кабинет: <a href="{{ env('APP_URL') . '/profile/auth?key=' . $user->auth_key }}">перейти</a>.</p>
<p>Инструкции по активации услуги {{ $privilege->title }}:
    <a href="{{ env('APP_URL') }}privileges/{{ $privilege->id }}#about">ознакомиться</a>.
</p>
С уважением,<br>
{{ env('MAIL_FROM_NAME') }}
