@extends('layouts.app')

@section('title', 'Настройки')

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Настройки</li>
            </ol>
            <h6 class="slim-pagetitle">Настройки</h6>
        </div>

        <div class="row row-sm">
            <div class="col-lg-8">
                <div class="card card-profile">
                    <div class="card-body">
                        <div class="media">
                            <img src="https://image.gametracker.com/images/maps/160x120/cs/cs_assault.jpg" width="120" height="120">
                            <div class="media-body">
                                <h3 class="card-profile-name">Полигон Смерти</h3>
                                <p class="card-profile-position">46.174.54.230:27015</p>
                                <p>Играют: 8 из 32</p>

                                <p class="mg-b-0"></p><p><strong>Изюминкой этого сервера являются постоянные обновления и нововведения. Все новые, интересные идеи обязательно воплощаются в жизнь на этом сервере</strong></p>

                                <p><img src="https://laravel.com/img/logomark.min.svg" alt=""></p>

                                <p><em>Только тут вы увидите: захват точек возрождения, уникальную систему званий, агрессивные раздатчики, продуманный до мельчайших деталей игровой процесс и много других ништяков.</em></p>

                                <h3>Взрослая, адекватная администрация спуску не дает читерам и нарушителям порядка, поэтому ваш ему игровому процессу ничего не будет мешать.</h3>
                                <p></p>
                            </div><!-- media-body -->
                        </div><!-- media -->
                    </div><!-- card-body -->
                </div><!-- card -->

                <ul class="nav nav-activity-profile mg-t-20">
                    <li class="nav-item">
                        <a href="steam://connect/46.174.54.230:27015" class="nav-link">
                            <i class="icon ion-ios-game-controller-b tx-purple"></i>Подключиться</a>
                    </li>
                    <li class="nav-item"><a href="http://site.test/payment/privilege" class="nav-link">
                            <i class="icon ion-ios-pricetags tx-primary"></i>Купить привилегию</a>
                    </li>
                    <li class="nav-item"><a href="http://site.test/donations" class="nav-link">
                            <i class="icon ion-heart tx-danger"></i>Поддержать проект</a>
                    </li>
                </ul>

                <div class="card card-recommendation mg-t-20">
                    <div class="card-body pd-25">
                        <div class="slim-card-title">Правила</div>
                        <p>
                        </p><blockquote>
                            <p>Взрослая адекватная администрация спуску не дает читерам и нарушителям порядка, поэтому вашему игровому процессу ничего не будет мешать.</p>
                        </blockquote>

                        <p></p>
                    </div>
                </div>
            </div><!-- col-8 -->

            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                <div class="card pd-25 mb-4">

                    <a class="btn btn-warning btn-block" href="http://site.test/servers/edit/2">Редактировать</a>
                </div>

                <div class="card pd-25">
                    <div class="slim-card-title">Сейчас играют:</div>

                    <div class="media-list mg-t-25">
                        <div class="media">
                            <div class="media-body mg-t-4 d-flex justify-content-between">
                                <h6 class="tx-14 tx-gray-700 w-100">RAEKWON-DA-CHEFF</h6>
                                <span class="d-block ml-2">14</span>
                                <span class="d-block w-25 text-right">35:42</span>
                            </div>
                        </div>
                        <hr>                                                    <div class="media">
                            <div class="media-body mg-t-4 d-flex justify-content-between">
                                <h6 class="tx-14 tx-gray-700 w-100">SentryGuns | TOP-MSI 999</h6>
                                <span class="d-block ml-2">11</span>
                                <span class="d-block w-25 text-right">31:20</span>
                            </div>
                        </div>
                        <hr>                                                    <div class="media">
                            <div class="media-body mg-t-4 d-flex justify-content-between">
                                <h6 class="tx-14 tx-gray-700 w-100">vk.com/sentryguns</h6>
                                <span class="d-block ml-2">5</span>
                                <span class="d-block w-25 text-right">11:38</span>
                            </div>
                        </div>
                        <hr>                                                    <div class="media">
                            <div class="media-body mg-t-4 d-flex justify-content-between">
                                <h6 class="tx-14 tx-gray-700 w-100">WATSON</h6>
                                <span class="d-block ml-2">7</span>
                                <span class="d-block w-25 text-right">21:37</span>
                            </div>
                        </div>
                        <hr>                                                    <div class="media">
                            <div class="media-body mg-t-4 d-flex justify-content-between">
                                <h6 class="tx-14 tx-gray-700 w-100">777</h6>
                                <span class="d-block ml-2">0</span>
                                <span class="d-block w-25 text-right">07:10</span>
                            </div>
                        </div>
                        <hr>                                                    <div class="media">
                            <div class="media-body mg-t-4 d-flex justify-content-between">
                                <h6 class="tx-14 tx-gray-700 w-100">Frost</h6>
                                <span class="d-block ml-2">2</span>
                                <span class="d-block w-25 text-right">30:49</span>
                            </div>
                        </div>
                        <hr>                                                    <div class="media">
                            <div class="media-body mg-t-4 d-flex justify-content-between">
                                <h6 class="tx-14 tx-gray-700 w-100">228</h6>
                                <span class="d-block ml-2">3</span>
                                <span class="d-block w-25 text-right">03:19</span>
                            </div>
                        </div>
                        <hr>                                                    <div class="media">
                            <div class="media-body mg-t-4 d-flex justify-content-between">
                                <h6 class="tx-14 tx-gray-700 w-100">konoval</h6>
                                <span class="d-block ml-2">4</span>
                                <span class="d-block w-25 text-right">03:04</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-people-list mg-t-20">
                    <div class="slim-card-title">Привилегии на сервере</div>
                    <div class="media-list">
                        <div class="media">
                            <img src="http://via.placeholder.com/500x500" alt="">
                            <div class="media-body">
                                <a href="/privileges/2" class="text-dark font-weight-bold">Випка</a>
                                <a href="/privileges/2#about" class="text-secondary">Смотреть описание</a>
                                <a href="/privileges/2#instruction" class="tx-danger">
                                    Как пользоваться?
                                </a>
                            </div>
                        </div>
                        <div class="media">
                            <img src="http://via.placeholder.com/500x500" alt="">
                            <div class="media-body">
                                <a href="/privileges/4" class="text-dark font-weight-bold">Админка</a>
                                <a href="/privileges/4#about" class="text-secondary">Смотреть описание</a>
                                <a href="/privileges/4#instruction" class="tx-danger">
                                    Как пользоваться?
                                </a>
                            </div>
                        </div>
                        <div class="media">
                            <img src="http://via.placeholder.com/500x500" alt="">
                            <div class="media-body">
                                <a href="/privileges/6" class="text-dark font-weight-bold">Вип для Девушек</a>
                                <a href="/privileges/6#about" class="text-secondary">Смотреть описание</a>
                                <a href="/privileges/6#instruction" class="tx-danger">
                                    Как пользоваться?
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
