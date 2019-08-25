@extends('layouts.app')

@section('title', 'Привилегия продлена!')

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <h6 class="slim-pagetitle mr-auto">Привилегия продлена!</h6>
        </div>
        <div class="section-wrapper">
            <div class="row row-sm">
                <div class="col-lg-12 text-center">
                    <p class="tx-20">Привилегия была успешно продлена.</p>
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-lg-12 text-center">
                    <a href="{{ route('profile') }}" class="btn btn-primary">Перейти в личный кабинет</a>
                </div>
            </div>
        </div>
    </div>
@endsection
