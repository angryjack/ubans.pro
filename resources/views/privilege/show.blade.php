@extends('layouts.app')

@section('title', 'Информация о услуге ' . $model->title)

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users') }}">Услуги</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $model->title }}</li>
            </ol>
            <h6 class="slim-pagetitle">@yield('title')</h6>
        </div>
        <div class="row row-sm">
            <div class="col-lg-8">

                <div class="card-recommendation" id="about">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-profile-name">{{ $model->title }}</h3>
                            <p class="card-profile-position">Сервер: <a
                                    href="/server/{{ $model->server->id }}">{{ $model->server->hostname }}</a></p>
                            <p>Доступ: <b>{{ $model->flags }}</b></p>
                            <hr>
                            <p class="mg-b-0">{!! Michelf\Markdown::defaultTransform($model->description) !!}</p>

                        </div><!-- card-body -->
                    </div>
                </div>

                @if(!empty($model->instruction))
                    <div class="card-recommendation mt-4" id="instruction">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-profile-name">Инструкции</h3>
                                <hr>
                                <p class="mg-b-0">{!! Michelf\Markdown::defaultTransform($model->instruction) !!}</p>

                            </div><!-- card-body -->
                        </div>
                    </div>
                @endif

                @if(!empty($model->server->rules))
                    <div class="card-recommendation mt-4" id="rules">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-profile-name">Правила игры на
                                    сервере {{ $model->server->hostname }}</h3>
                                <hr>
                                <p class="mg-b-0">{!! Michelf\Markdown::defaultTransform($model->server->rules) !!}</p>

                            </div><!-- card-body -->
                        </div>
                    </div>
                @endif
            </div><!-- col-8 -->

            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                @auth('admin')
                    <div class="card pd-25 mb-4">

                        <a class="btn btn-warning btn-block"
                           href="{{ route('privileges.edit', ['id' => $model->id]) }}">Редактировать</a>
                    </div>
                @endif
                <div class="card card-connection">
                    @forelse($model->rates as $rate)
                        <div class="row row-xs">
                            <div class="col-4 @if($loop->even) tx-primary @else tx-purple @endif">
                                {{ $rate->price }}
                            </div>
                            <div class="col-8">
                                <p class="m-0">Рублей</p>
                                Сроком @if($rate->term === 0) навсегда @else на {{ $rate->term }} дней @endif
                            </div>
                        </div><!-- row -->
                        @if (!$loop->last)
                            <hr>
                        @endif
                    @empty
                        Тарифов нет.
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
