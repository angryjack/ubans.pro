@extends('layouts.app')

@section('title', 'Страница не найдена')

@section('content')
    <div class="container">
        <div class="page-error-wrapper">
            <div>
                <h1 class="error-title">404</h1>
                <h5 class="tx-sm-24 tx-normal">Упс. Запрошенная страница не существует.</h5>
                <p class="mg-b-50">Возможно Вы ошиблись с вводом либо страница было удалена.</p>
                <p class="mg-b-50"><a href="{{ route('home') }}" class="btn btn-error">На главную</a></p>
                <p class="error-footer">© {{ env('APP_NAME') }} {{ date('Y') }}. Все права защищены.</p>
            </div>

        </div>
    </div>
@endsection
