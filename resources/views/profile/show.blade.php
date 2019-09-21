@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="container mt-3">
        <div class="row row-sm">
            <div class="col-lg-8">
                <div class="card card-profile">
                    <div class="card-body">
                        <div class="media">
                            <img src="https://via.placeholder.com/500x500" alt="">
                            <div class="media-body">
                                <h3 class="card-profile-name">{{ $model->nickname }}</h3>
                                <p>{{ $model->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bd-l bd-3 bd-danger bg-gray-200 pd-x-20 pd-y-25">
                        <h5 class="tx-danger">Не получается войти на сервер? Обновите пароль!</h5>
                        <p class="mg-b-0">На сайте нужно вводить пароль <b>БЕЗ приставки setinfo _pw</b></p>
                        <p class="mg-b-0">После того, как поменяли пароль на сайте, необходимо подождать 3 минуты и
                            ввести в кс новый пароль <b>(в кс нужно вводить с приставкой)</b>: setinfo _pw новыйПароль
                        </p>
                        <p class="mg-b-0">Смена пароля произойдет в течение 3-х минут! </p>
                    </div>
                </div>
                <div class="row row-sm">
                    @forelse($model->privileges as $privilege)
                        <div class="col-lg-6 mg-t-20">
                            <div class="card card-info">
                                <div class="card-body pd-40 server-{{ $privilege['server']->id }}">
                                    <h5 class="tx-inverse mg-b-20">{{ $privilege['server']->hostname }}</h5>
                                    <input type="hidden" name="name" value="{{ $model->steamid }}">
                                    <input type="hidden" name="email" value="{{ $model->email }}">
                                    @if($privilege['privilege'])
                                        <p class="tx-18">{{ $privilege['privilege']->title }}</p>
                                        <p>Действует до: <b>{{ $privilege['expire'] }}</b></p>
                                        @if($privilege['server']->pivot->expire !== null && $privilege['privilege']->rates)
                                            <div class="form-group">
                                                <select class="form-control select2-show-search select2-hidden-accessible"
                                                        name="rate">
                                                    @foreach($privilege['privilege']->rates as $rate)
                                                        <option value="{{ $rate->id }}">
                                                            @if ($rate->term === 0)
                                                                Навсегда
                                                            @else
                                                                {{ $rate->term  }} дн.
                                                            @endif
                                                             - {{ $rate->price }} руб.
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button class="btn btn-teal btn-block extend-privilege"
                                                    data-server="{{ $privilege['server']->id }}">Продлить</button>
                                        @endif
                                    @else
                                        <p>Привилегию невозможно продлить.</p>
                                        <p>Доступ на сервере: <b>{{ $privilege['flags'] }}</b></p>
                                        <p>Действует до: <b>{{ $privilege['expire'] }}</b></p>
                                    @endif
                                </div><!-- card -->
                            </div><!-- card -->
                        </div>
                    @empty
                        <div class="col-lg-6 mg-t-20">
                            <div class="card card-info">
                                <div class="card-body pd-40">
                                    <h5 class="tx-inverse mg-b-20">Услуги не найдены</h5>
                                    <p>Покупка привилегии способствует дальнейшему развитию проекта.</p>
                                    <a href="{{ route('privilege.buy') }}"
                                       class="btn btn-primary btn-block">Купить</a>
                                </div><!-- card -->
                            </div><!-- card -->
                        </div>
                    @endforelse
                </div>
            </div><!-- col-8 -->

            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                <div class="card pd-25">
                    <div class="slim-card-title">Контакты проекта</div>

                    <div class="media-list mg-t-25">
                        @include('custom.contacts')
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body pd-30 update-profile-form" data-action="{{ route('profile.update') }}">
                        <h6 class="slim-card-title">Обновить информацию</h6>

                        <div class="form-group">
                            <label class="form-control-label">Ник</label>
                            <input type="text" name="nickname" class="form-control" value="{{ $model->steamid }}" required>
                            <p class="errors parsley-errors-list mt-2"></p>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Новый пароль (Вводить без setinfo _pw)</label>
                            <input type="text" name="password" class="form-control">
                            <p class="errors parsley-errors-list mt-2"></p>
                        </div>

                        <div class="mg-t-30">
                            <button class="btn btn-primary pd-x-20 do-update">Сохранить</button>
                        </div>
                    </div><!-- card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
