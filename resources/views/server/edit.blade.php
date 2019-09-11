@extends('layouts.app')

@section('title', 'Редактировать сервер')

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('servers') }}">Сервера</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $model->hostname }}</li>
            </ol>
            <h6 class="slim-pagetitle">@yield('title')</h6>
        </div>

        <div class="section-wrapper">
            @include('server.form')
        </div>
    </div>
@endsection
