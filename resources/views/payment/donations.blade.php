@extends('layouts.app')

@section('title', 'Пожертвования')

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <h6 class="slim-pagetitle mr-auto">Ваши пожертвования</h6>
        </div>
        <div class="card-columns mg-t-20">
            <form class="card card-body pd-25" action="{{ route('donations') }}" method="post">
                <h6 class="slim-card-title mg-b-20">Поддежрать проект</h6>
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Ваше имя">
                </div>
                <div class="form-group">
                    <input type="number" name="amount" class="form-control" placeholder="Сумма" min="1" value="250">
                </div>
                <div class="form-group">
                    <textarea name="message" class="form-control" rows="2" placeholder="Ваше сообщение"></textarea>
                </div>
                <button class="btn btn-danger btn-block make-donation">
                    <i class="fa fa-heart mg-r-5"></i>Пожертвовать
                </button>
            </form>

            @foreach($donations as $donation)
                <div class="card card-body pd-25">
                    <h6 class="slim-card-title tx-sm-20">{{ $donation->title }}</h6>
                    <p>{{ $donation->message }}</p>
                    <p class="tx-teal tx-sm-26">{{ $donation->amount }} ₽</p>
                    <p class="blog-date text-right mb-0">{{ $donation->created }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
