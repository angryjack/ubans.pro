@extends('layouts.app')

@section('title', 'Произошла ошибка!')

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <h6 class="slim-pagetitle mr-auto">Произошла ошибка!</h6>
        </div>
        <div class="section-wrapper">
            <div class="row row-sm mt-4">
                <div class="col-lg-12 text-center">
                    <p class="tx-20">При оплате услуги произошла ошибка.
                        <br>Пожалуйста, свяжитесь с администрацией проекта.
                        <br><p class="tx-20 font-weight-bold text-dark mt-3">{{ env('MAIL_FROM_ADDRESS') }}</p>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
