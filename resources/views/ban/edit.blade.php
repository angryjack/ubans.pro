@extends('layouts.app')

@section('title', 'Редактировать бан игрока ' . $model->player_nick)

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item"><a href="/bans">Баны</a></li>
                <li class="breadcrumb-item active" aria-current="page">Редактировать</li>
            </ol>
            <h6 class="slim-pagetitle">@yield('title')</h6>
        </div>

        <div class="section-wrapper">
            <form class="form-layout" action="{{ route('bans.update') }}" method="post">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
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
                            <li class="list-group-item">
                                <p class="mg-b-0"><strong class="tx-inverse tx-medium">IP</strong>
                                    <span class="text-muted">{{ $model->player_ip }}</span>
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

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Продолжительность (мин): <span class="tx-danger">*</span></label>
                            <select class="form-control select2-show-search select2-hidden-accessible" name="ban_length" required>
                                @php
                                    $options = [
                                        'Разбанить' => '-1',
                                        'Навсегда' => 0,
                                        '5 минут' => 5,
                                        '30 минту' => 30,
                                        'час' => 60,
                                        '5 часов' => 300,
                                        'cутки' => 1440,
                                        '3 дня' => 4320,
                                        'неделя' => 43200,
                                        'месяц' => 10080,
                                    ];
                                @endphp

                                @foreach($options as $title => $option)
                                    <option value="{{ $option }}">{{ $title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Причина: <span class="tx-danger">*</span></label>
                            <textarea name="ban_reason" rows="3" class="form-control" placeholder="Укажите причину"
                                      required>{{ $model->ban_reason }}</textarea>
                        </div>
                        <input type="text" name="bid" hidden value="{{ $model->bid }}">
                    </div>
                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-primary bd-0">Сохранить</button>
                    <a href="/bans/{{ $model->bid }}" class="btn btn-secondary bd-0">Отменить</a>
                </div><!-- form-layout-footer -->
            </form><!-- form-layout -->
        </div>

    </div>
@endsection
