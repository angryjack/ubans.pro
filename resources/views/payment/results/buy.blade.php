@extends('layouts.app')

@section('title', 'Вы купили привилегию.')

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <h6 class="slim-pagetitle mr-auto">Покупка привилегии</h6>
        </div>
        <div class="section-wrapper">
            <div class="row row-sm">
                <div class="col-lg-12 text-center">
                    <p class="tx-22 text-dark">Спасибо за совершенную покупку!</p>
                </div>
            </div>
            <hr class="mg-b-30">
            <div class="row row-sm">
                <div class="col-lg-6">
                    <div class="bd-l bd-3 bd-success bg-gray-200 pd-x-20 pd-y-25">
                        <h5 class="tx-success">Для входа на сервер используйте данные:</h5>
                        <p class="mg-b-0">Ник: <b>{{ $user->steamid }}</b></p>
                        <p class="mg-b-0">Пароль: <b>setinfo _pw {{ substr($user->auth_key, 0, 8) }}</b></p>
                    </div>
                </div>
            </div>
            <div class="row row-sm mt-4">
                <div class="col-lg-4">
                    <p class="tx-20 text-dark">Как активировать услугу?</p>
                    <p>
                        После оплаты услуги на указанный вами ник устанавливается пароль.
                        Соответственно, чтобы зайти на сервер под этим ником и начать пользоваться привилегиями
                        необходимо ввести Ваш пароль в консоль.
                        <br>
                        <b>Ваш пароль: setinfo _pw {{ substr($user->auth_key, 0, 8) }}</b>
                        <br>
                        Вводиться в консоль перед заходом на сервер. Его достаточно ввести один раз, после он
                        сохраниться в памяти вашей игры.
                        Если вы поменяли/переустановили counter-strike вам потребуется снова ввести пароль.
                    </p>
                </div>
                <div class="col-lg-4">
                    <p class="tx-20 text-dark">Как пользоваться?</p>
                    <p>
                        Cамостоятельное обновление пушек и раздатчиков, иммунитет, приставка в чате работают сразу, эти
                        возможности не нужно активировать.
                        <br>
                        Чтобы открыть ВИП меню необходимо написать в консоль команду <b>vipmenu</b> или в игровой чат
                        <b>/vipmenu.</b>
                        Для быстрого доступа рекомендую использовать бинд: <b>bind "-" vipmenu</b>
                        <br>
                        Чтобы изменить приставку перед ником необходимо ввести <b>/pr</b> приставка в чат.
                        Стандартной является приставка - [VIP].
                    </p>
                </div>
                <div class="col-lg-4">
                    <p class="tx-20 text-dark">Возможные ошибки и пути их решения:</p>
                    <p>
                        <b>Не могу зайти на сервер, меня кикает. Причина - Kicked :"Invalid admin password"</b>
                        <br>
                        Вы не ввели ваш пароль или ввели его неверно. Напоминаю - пароль вводиться перед заходом на
                        сервер!
                    <hr>
                    <b>Зашел на сервер, а услуги нет</b>
                    <br>
                    Проверяйте ник, который вы указывали при оплате услуги. Он должен совпадать символ в символ, иначе
                    услуга не будет работать. Обращайте также внимание на регистр букв! TeSt и test - разные ники!
                    </p>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12 text-right">
                    <a href="/profile/auth?key={{ $user->auth_key }}" class="btn btn-primary">Перейти в личный кабинет</a>
                </div>
            </div>
        </div>
    </div>
@endsection
