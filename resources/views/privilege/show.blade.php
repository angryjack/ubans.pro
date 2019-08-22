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
        <div class="section-wrapper">
            @auth('admin')
                <div class="row">
                    <div class="col-sm-6 col-md-3 mg-b-10">
                        <a class="btn btn-warning btn-block"
                           href="{{ route('privileges.edit', ['id' => $model->id]) }}">Редактировать</a>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Название</strong>
                                <span class="text-muted">{{ $model->title }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Сервер</strong>
                                <span class="text-muted">{{ $model->server->hostname }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="mg-b-0"><strong class="tx-inverse tx-medium">Доступ</strong>
                                <span class="text-muted">{{ $model->flags }}</span>
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-8">
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <span class="text-muted">{!! $model->description !!}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection
