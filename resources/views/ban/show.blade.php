@extends('layouts.app')

@section('title', 'Информация о бане ' . $model->player_nick)

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item"><a href="/bans">Бан-лист</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $model->player_nick }}</li>
            </ol>
            <h6 class="slim-pagetitle">@yield('title')</h6>
        </div>

        <div class="section-wrapper">
            @auth(\App\Models\User::ROLE_EDITOR)
                <div class="row">
                    <div class="col-sm-6 col-md-3 mg-b-10">
                        <a class="btn btn-warning btn-block" href="/bans/edit/{{ $model->bid }}">Редактировать</a>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Ник</strong>
                                <span class="text-muted">{{ $model->player_nick }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Steam ID</strong>
                                <span class="text-muted">{{ $model->player_id }}</span>
                            </p>
                        </li>
                        @auth(\App\Models\User::ROLE_ADMIN)
                            <li class="list-group-item">
                                <p class="mg-b-0"><strong class="tx-inverse tx-medium">IP</strong>
                                    <span class="text-muted">{{ $model->player_ip }}</span>
                                </p>
                            </li>
                        @endif
                    </ul>
                </div><!-- col-4 -->
                <div class="col-md-6 col-lg-4 mg-t-20 mg-md-t-0-force">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p class="mg-b-0">
                                <strong class="tx-inverse tx-medium">Причина бана</strong>
                                <span class="text-muted">{{ $model->ban_reason }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0">
                                <strong class="tx-inverse tx-medium">Дана бана</strong>
                                <span class="text-muted">{{ $model->created }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0">
                                <strong class="tx-inverse tx-medium">Забанен админом</strong>
                                <span class="text-muted">{{ $model->admin_nick }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0">
                                <strong class="tx-inverse tx-medium">Истекает</strong>
                                <span class="text-muted">{{ $model->expire_at }}</span>
                            </p>
                        </li>
                    </ul>
                </div><!-- col-4 -->
                <div class="col-md-6 col-lg-4 mg-t-20 mg-lg-t-0-force">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p class="mg-b-0">
                                <strong class="tx-inverse tx-medium">Сервер</strong>
                                <span class="text-muted">{{ $model->server_name }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0">
                                <strong class="tx-inverse tx-medium">IP сервера</strong>
                                <span class="text-muted">{{ $model->server_ip }}</span>
                            </p>
                        </li>
                    </ul>
                </div><!-- col-4 -->
            </div><!-- row -->
        </div>

    </div>
@endsection
