@extends('layouts.app')

@section('title', 'Услуги')

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
                        <a class="btn btn-teal btn-block" href="{{ route('privileges.create') }}">Добавить</a>
                    </div>
                    <div class="col-sm-6 col-md-3 mg-b-10 mg-l-auto">
                        <input class="form-control" placeholder="Поиск" type="text">
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Сервер</th>
                        <th>Флаги</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($list as $privilege)
                        <tr onclick="window.location.href='{{ route('privileges.show', ['id' => $privilege->id]) }}'">
                            <td>{{ $privilege->title }}</td>
                            <td>{{ $privilege->server->hostname }}</td>
                            <td>{{ $privilege->flags }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Услуг нет</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @include('components.pagination', ['linkLimit' => 7])
        </div>

    </div>
@endsection
