@extends('layouts.app')

@section('title', 'Редактировать пользователя')

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item"><a href="/users">Пользователи</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $form->user->nickname }}</li>
            </ol>
            <h6 class="slim-pagetitle">@yield('title')</h6>
        </div>

        <div class="section-wrapper">
            @include('user.form')
        </div>

    </div>
@endsection
