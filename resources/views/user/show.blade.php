@extends('layouts.app')

@section('title', 'Информация о пользователе ' . $model->nickname)

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users') }}">Пользователи</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $model->nickname }}</li>
            </ol>
            <h6 class="slim-pagetitle">@yield('title')</h6>
        </div>
        <div class="section-wrapper">
            <div class="row">
                <div class="col-sm-6 col-md-3 mg-b-10">
                    <a class="btn btn-warning btn-block" href="{{ route('users.edit', ['id' => $model->id]) }}">Редактировать</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Логин</strong>
                                <span class="text-muted">{{ $model->nickname }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Почта</strong>
                                <span class="text-muted">{{ $model->email }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Роль</strong>
                                <span class="text-muted">{{ $model->role_list[$model->role] }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Уникальная ссылка</strong>
                                <span class="text-muted">{{ env('APP_URL') . '/profile/auth?key=' . $model->auth_key }}</span>
                            </p>
                        </li>

                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Флаги доступа</strong>
                                <span class="text-muted">{{ $model->access }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Доступ</strong>
                                <span class="text-muted">
                                    @isset ($model->flag_list[$model->flags])
                                        {{ $model->flag_list[$model->flags] }}
                                    @else
                                        {{ $model->flags }}
                                    @endif
                                </span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Ник / SteamID / IP</strong>
                                <span class="text-muted">{{ $model->steamid }}</span>
                            </p>
                        </li>
                    </ul>
                </div><!-- col-4 -->

                @foreach($model->servers as $server)
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header tx-medium bd-0 tx-white bg-mantle">
                                <p class="mg-b-0">{{ $server->hostname }}</p>
                            </div>
                            <div class="card-body">
                                @if(empty($server->pivot->custom_flags) || $server->pivot->custom_flags === 'yes')
                                    <p class="tx-semibold mb-0">Флаги доступа</p>
                                    {{ $model->access }}
                                @endif
                                {{ $server->pivot->custom_flags }}

                                @if(!empty($server->pivot->expire))
                                    <p class="tx-semibold mb-0">Истекает</p>
                                    @php echo date('d.m.Y H:i', strtotime($server->pivot->expire)); @endphp
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
