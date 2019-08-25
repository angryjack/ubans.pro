<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }} - Войти</title>
    <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/slim.min.css">
    @if(env('THEME_BLACK'))
        <link rel="stylesheet" href="/css/slim.one.css">
    @endif
</head>
<body>
<div class="d-md-flex flex-row-reverse">
    <div class="signin-right">
        <div class="signin-box">
            <h2 class="signin-title-primary">С Возвращением!</h2>
            <h3 class="signin-title-secondary">Войдите чтобы продолжить.</h3>
            <form action="{{ route('signin') }}" method="post">
                <div class="form-group">
                    <input type="text" name="login" class="form-control" placeholder="Введите логин"
                           required>
                </div><!-- form-group -->
                <div class="form-group mg-b-50">
                    <input type="password" name="password" class="form-control" placeholder="Введите пароль"
                           minlength="5"
                           required>
                    <ul class="parsley-errors-list filled">
                        <li class="parsley-required tx-14 error-container"></li>
                    </ul>
                </div><!-- form-group -->
                <span class="do-login btn btn-primary btn-block btn-signin">Войти</span>
            </form>
            {{--<p class="mg-b-0">Нет аккаунта? <a href="{{ route('signup') }}">Пройдите регистрацию</a></p>--}}
        </div>

    </div>
    <div class="signin-left">
        <div class="signin-box">
            <h2 class="slim-logo"><a href="{{ route('home') }}">{{ env('APP_NAME') }}<span>.</span></a></h2>

            <p>Игровое сообщество посвященное игре Counter Strike 1.6</p>
            <p>Наши сервера:</p>
            <p>Суровая Нереальность <b>46.174.55.18:27015</b> <br>
                Полигон Смерти <b>46.174.54.230:27015</b> <br>
            Жара <b>46.174.54.105:27015</b></p>
            <p>Мы существуем с 2014 года и за это время у нас сложился большой и дружный коллектив.
                Присоединяйтесь к нам и вы не пожалеете!</p>

            <p><a href="{{ route('home') }}" class="btn btn-outline-secondary pd-x-25">Подробнее</a></p>

            <p class="tx-12">© Copyright @php echo date('Y') @endphp. Все права защищены.</p>
        </div>
    </div>
</div>

<script src="/lib/jquery/js/jquery.js"></script>
<script src="/js/components/Signin.js"></script>

</body>
</html>
