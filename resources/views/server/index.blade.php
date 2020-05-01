@extends('layouts.app')

@section('title', 'Сервера')

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
            <h6 class="slim-pagetitle">@yield('title')</h6>
        </div>

        <div class="row">
            @foreach($list as $server)
                <div class="col-lg-6 mb-4">
                    <div class="card card-profile">
                        <div class="card-body">
                            <div class="media">
                                @if ($server->info['Map'] === 'nomap')
									<img src="{{URL::asset('images/nomap.jpg')}}" width="120" height="120">
								@else
									<img src="https://image.gametracker.com/images/maps/160x120/cs/{{ $server->info['Map'] }}.jpg"
                                     width="120" height="120">
								@endif
                                <div class="media-body">
                                    <h3 class="card-profile-name">
                                        <a class="text-dark" href="/servers/{{ $server->id }}">{{ $server->hostname }}</a>
                                    </h3>
                                    <p class="mb-1">{{ $server->address }}</p>
                                    <b>Онлайн: {{ $server->info['Players'] }}/{{ $server->info['MaxPlayers'] }}</b>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="list-group list-group-flush w-100">
                                <div class="list-group-item bg-gray-200">
                                    <div class="media">
                                        <div class="media-body ml-0 d-flex">
                                            <b>Игрок</b>
                                            <b class="ml-auto w-25 text-right">Убийств</b>
                                            <b class="w-25 text-right">Время</b>
                                        </div>
                                    </div>
                                </div>
                                @forelse($server->players as $player)
                                    <div class="list-group-item">
                                        <div class="media">
                                            <div class="media-body ml-0 d-flex">
                                                <b>{{ $player['Name'] }}</b>
                                                <span class="ml-auto w-25 text-right">{{ $player['Frags'] }}</span>
                                                <span class="w-25 text-right">{{ $player['TimeF'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="list-group-item">
                                        <div class="media">
                                            <div class="media-body ml-0 d-flex">
                                                <b>Игроков нет.</b>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
