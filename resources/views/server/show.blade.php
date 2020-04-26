@extends('layouts.app')

@section('title', 'Сервер ' . $model->hostname)

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item"><a href="/servers">Сервера</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $model->hostname }}</li>
            </ol>
            <h6 class="slim-pagetitle">@yield('title')</h6>
        </div>

        <div class="row row-sm">
            <div class="col-lg-8">
                <div class="card card-profile">
                    <div class="card-body">
                        <div class="media">
                            @if ($model->info['Map'] === 'nomap')
								<img src="{{URL::asset('images/nomap.jpg')}}" width="120" height="120">
							@else
								<img src="https://image.gametracker.com/images/maps/160x120/cs/{{ $model->info['Map'] }}.jpg"
								 width="120" height="120">
							@endif
                            <div class="media-body">
                                <h3 class="card-profile-name">{{ $model->hostname }}</h3>
                                <p class="card-profile-position">{{ $model->address }}</p>
                                <p>Играют: {{ $model->info['Players'] }} из {{ $model->info['MaxPlayers'] }}</p>

                                <p class="mg-b-0">{!! Michelf\Markdown::defaultTransform($model->description) !!}</p>
                            </div><!-- media-body -->
                        </div><!-- media -->
                    </div><!-- card-body -->
                </div><!-- card -->

                <ul class="nav nav-activity-profile mg-t-20">
                    <li class="nav-item">
                        <a href="steam://connect/{{ $model->address }}" class="nav-link">
                            <i class="icon ion-ios-game-controller-b tx-purple"></i>Подключиться</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('privilege.buy') }}" class="nav-link">
                            <i class="icon ion-ios-pricetags tx-primary"></i>Купить привилегию</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('donations') }}" class="nav-link">
                            <i class="icon ion-heart tx-danger"></i>Поддержать проект</a>
                    </li>
                </ul>

                <div class="card card-recommendation mg-t-20">
                    <div class="card-body pd-25">
                        <div class="slim-card-title">Правила</div>
                        <p>
                            @empty($model->rules)
                                Правила не добавлены.
                            @else
                                {!! Michelf\Markdown::defaultTransform($model->rules) !!}
                            @endif
                        </p>
                    </div>
                </div>
            </div><!-- col-8 -->

            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                @auth('admin')
                    <div class="card pd-25 mb-4">

                        <a class="btn btn-warning btn-block"
                           href="{{ route('servers.edit', ['id' => $model->id]) }}">Редактировать</a>
                    </div>
                @endif

                <div class="card pd-25">
                    <div class="slim-card-title">Сейчас играют:</div>

                    <div class="media-list mg-t-25">
                        @forelse($model->players as $player)
                            <div class="media">
                                <div class="media-body mg-t-4 d-flex justify-content-between">
                                    <h6 class="tx-14 tx-gray-700 w-100">{{ $player['Name'] }}</h6>
                                    <span class="d-block ml-2">{{ $player['Frags'] }}</span>
                                    <span class="d-block w-25 text-right">{{ $player['TimeF'] }}</span>
                                </div>
                            </div>
                            @if (!$loop->last)
                                <hr>@endif
                        @empty
                            <div class="media">
                                <div class="media-body mg-t-4 d-flex justify-content-between">
                                    <h6 class="tx-14 tx-gray-700 w-100">Игроков нет.</h6>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="card card-people-list mg-t-20">
                    <div class="slim-card-title">Привилегии на сервере</div>
                    <div class="media-list">
                        @forelse($model->privileges as $privilege)
                            <div class="media">
                                <img src="http://via.placeholder.com/500x500" alt="">
                                <div class="media-body">
                                    <a href="/privileges/{{ $privilege->id }}"
                                       class="text-dark font-weight-bold"
                                    >{{ $privilege->title }}</a>
                                    <a href="/privileges/{{ $privilege->id }}#about"
                                        class="text-secondary"
                                    >Смотреть описание</a>
                                    <a href="/privileges/{{ $privilege->id }}#instruction"
                                        class="tx-danger"
                                    >
                                        Как пользоваться?
                                    </a>
                                </div>
                            </div>
                        @empty
                            Привилегий нет.
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
