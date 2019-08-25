@extends('layouts.app')

@section('title', 'Бан-лист')

@section('content')
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
            <h6 class="slim-pagetitle">@yield('title')</h6>
        </div>

        <div class="section-wrapper">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-sm-6 col-md-3 mg-b-10 mg-l-auto">
                        <input class="form-control bans-search" placeholder="Поиск" type="text">
                    </div>
                </div>
                <table class="table data-bans">
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Ник</th>
                        <th>Причина</th>
                        <th>Админ</th>
                        <th>Истекает</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($list as $ban)
                        <tr @if(!$ban->is_active) class="table table-teal" @endif
                        onclick="window.location.href='{{ route('bans.show', ['id' => $ban->bid]) }}'">
                            <th scope="row">{{ $ban->created }}</th>
                            <td>{{ $ban->player_nick }}</td>
                            <td>{{ $ban->ban_reason }}</td>
                            <td>{{ $ban->admin_nick }}</td>
                            <td>{{ $ban->expire_at }}</td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5">Банов нет</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @include('components.pagination', ['linkLimit' => 7])
        </div>

    </div>
@endsection
