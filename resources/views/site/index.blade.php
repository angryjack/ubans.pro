@extends('layouts.app')

@section('title', env('APP_NAME') . ' - Главная')

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <h6 class="slim-pagetitle mr-auto">Главная</h6>
        </div>
        <div class="row row-sm">
            <div class="col-md-6 col-lg-4 mg-t-10 mg-md-t-0 order-lg-4">
                <div class="card card-info">
                    <div class="card-body pd-40">
                        <div class="d-flex justify-content-center mg-b-30">
                            <img src="/images/icon2.svg" class="wd-100" alt="">
                        </div>
                        <h5 class="tx-inverse mg-b-20">Купить Услугу</h5>
                        <p>Купить услугу можно выполнив 3 простых шага.</p>
                        <a href="{{ route('privilege.buy') }}" class="btn btn-primary btn-block">Купить</a>
                    </div>
                </div>
                <div class="card card-info mt-3">
                    <div class="card-body pd-40">
                        <div class="d-flex justify-content-center mg-b-30">
                            <img src="https://bumper-stickers.ru/44914-thickbox_default/krasnoe-serdce.jpg"
                                 class="wd-100 h-100" alt="">
                        </div>
                        <h5 class="tx-inverse mg-b-20">Поддержать проект</h5>
                        <p>Все вырученные с продаж услуг средства идут на развитие нашего проекта: арендную плату
                            серверов, рекламы, различные доработки и улучшения игрового процесса на серверах.</p>
                        <a href="{{ route('donations') }}" class="btn btn-primary btn-block">Поддержать</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mg-t-10 mg-lg-t-0 order-lg-2">
                <div class="card card-quick-post">
                    @include('custom.main')
                </div>
            </div>
        </div>
    </div>
@endsection
