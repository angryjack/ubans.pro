@extends('layouts.app')

@section('title', 'Купить услугу')

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
            <h6 class="slim-pagetitle">@yield('title')</h6>
        </div>
        <div class="section-wrapper mg-t-20">
            <label class="section-title">Купить услугу</label>
            <p class="mg-b-20 mg-sm-b-40">Выполните 3 простых шага и услуга будет Ваша!</p>
            <div id="payment-privilege" role="application" class="wizard wizard-style-1 clearfix">
                <h3>Информация об услуге</h3>
                <section class="row row-xs">
                    <div class="col-lg-5">
                        <div class="form-group wd-xs-300">
                            <label class="form-control-label">Сервер: <span class="tx-danger">*</span></label>
                            <select class="form-control select2-show-search select2-hidden-accessible" name="server">
                                <option selected disabled="">Выберите сервер</option>
                                @foreach($servers as $server)
                                    <option value="{{ $server->id }}">{{ $server->hostname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group wd-xs-300" style="display: none;">
                            <label class="form-control-label">Услуга: <span class="tx-danger">*</span></label>
                            <select class="form-control select2-show-search select2-hidden-accessible"
                                    name="privilege"></select>
                        </div>
                        <div class="form-group wd-xs-300" style="display: none;">
                            <label class="form-control-label">Тариф: <span class="tx-danger">*</span></label>
                            <select class="form-control select2-show-search select2-hidden-accessible"
                                    name="rate"></select>
                        </div>
                    </div>
                    <div class="col-lg-7 content-body">
                    </div>
                </section>
                <h3>Информация игрока</h3>
                <section>
                    @auth
                        <p class="text-danger">Если Вы хотите указать другой ник или почту - выйдите из своего аккаунта.</p>
                    @else
                        <p>Укажите действующую почту и Ваш игровой ник.</p>
                    @endif
                    <div class="form-group wd-xs-300">
                        <label class="form-control-label">Почта: <span class="tx-danger">*</span></label>
                        <input class="form-control" name="email"
                               placeholder="Укажите почту" type="email" required=""
                               @auth value="{{ Auth::user()->email }}" disabled @endif>
                    </div>
                    <div class="form-group wd-xs-300">
                        <label class="form-control-label">Ник: <span class="tx-danger">*</span></label>
                        <input class="form-control" name="nickname"
                               placeholder="Укажите ник" type="text" required=""
                               @auth value="{{ Auth::user()->nickname }}" disabled @endif>
                    </div>
                </section>
                <h3>Правила проекта</h3>
                <section>
                    <center style="font-size:20px; font-weight: bold;">Правила</center>
                    <br>
                    <div style="font-size:15px; color: #000">
                        <p><b>1.</b> Запрещено использовать чит-софт (aimbot, wh, speedhack, cd-hack, norecoil и пр.)
                        </p>
                        <p><b>2.</b> Запрещены оскорбления и провокации в любом виде! За оскорбления близких и
                            родственников - бан НАВСЕГДА!</p>
                        <p><b>3.</b> Запрещено использовать уязвимости и баги сервера.</p>
                        <p><b>4.</b> Запрещена реклама и спам в любом виде.</p>
                        <p><b>5.</b> Запрещено разжигать межнациональную рознь и обсуждать политику.</p>
                        <p><b>6.</b> Запрещено обсуждение каких-либо действий администратора в игре.</p>
                        <p><b>7.</b> Запрещено нарушать игровой баланс! При заходе за определенную команду обращать
                            внимание на общую игровую обстановку и присоединяться к проигрывающей команде. Игровая
                            обстановка определяется по кол-ву пушек в командах. Если ваша команда выигрывает, вы должны
                            перейти за слабую команду, тем самым уровняв игру.</p>
                        <p><b>8.</b> Запрещено использовать недочеты карт: текстуры, засветы и т.д.</p>
                        <br>
                        <center style="font-size:16px; font-weight: bold;">Наказание:</center>
                        <br>
                        <p>Нарушение правил ведет к немедленой блокировке доступа к серверу с дальнейшим изъятием услуги
                            <b>без возврата денежных средств!</b></p>
                        <p>Администрация вправе сделать предупреждение в виде кика, либо бана на неопределенный срок за
                            нарушение любого пункта из перечисленных выше правил.</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
