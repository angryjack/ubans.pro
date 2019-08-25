@extends('layouts.app')

@section('title', 'Пользователи')

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
                    <div class="col-sm-6 col-md-3 mg-b-10">
                        <a class="btn btn-teal btn-block" href="{{ route('users.create') }}">Добавить</a>
                    </div>
                    <div class="col-sm-6 col-md-3 mg-b-10 mg-l-auto">
                        <input class="form-control users-search" placeholder="Поиск" type="text">
                    </div>
                </div>
                <table class="table data-users">
                    <thead>
                    <tr>
                        <th>Логин</th>
                        <th>Почта</th>
                        <th>Доступ</th>
                        <th>Роль</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($list as $user)
                        <tr onclick="window.location.href='{{ route('users.show', ['id' => $user->id]) }}'">
                            <td>{{ $user->nickname}}</td>
                            <td>{{ $user->email}}</td>
                            <td>@isset($user->flag_list[$user->flags])
                                    {{ $user->flag_list[$user->flags]}}
                                @else
                                    {{ $user->flags }}
                                @endif
                            </td>
                            <td>{{ $user->role_list[$user->role]}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Пользователей нет</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @include('components.pagination', ['linkLimit' => 7])
        </div>

    </div>
@endsection
