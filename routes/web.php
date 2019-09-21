<?php

use App\Models\User;

//Сайт
$router->get('/', ['as' => 'home', 'uses' => 'SiteController@index']);

//Вход-выход
$router->get('signin', ['as' => 'signin', 'uses' => 'SiteController@signinPage']);
$router->post('signin', ['as' => 'signin', 'uses' => 'SiteController@signin']);
$router->get('signout', ['as' => 'signout', 'uses' => 'SiteController@signout']);

// профиль
$router->group(['prefix' => 'profile'], function () use ($router) {
    $router->get('/', ['as' => 'profile', 'middleware' => 'auth', 'uses' => 'UserController@profile']);
    $router->get('/auth', 'SiteController@auth');
    $router->post('/update', ['as' => 'profile.update', 'middleware' => 'auth', 'uses' => 'UserController@updateProfile']);
});

// оплата
$router->group(['prefix' => 'payment'], function () use ($router) {
    $router->get('/handle', 'PaymentController@handle');
    $router->get('/result', 'PaymentController@result');
    $router->post('/redirect', 'PaymentController@redirect');
});

// баны
$router->group(['prefix' => 'bans'], function () use ($router) {
    $router->get('/', ['as' => 'bans', 'uses' => 'BanController@index']);
    $router->get('/{id}', ['as' => 'bans.show', 'uses' => 'BanController@show']);
    $router->get('/edit/{id}', ['as' => 'bans.edit', 'middleware' => ['auth', 'role:' . User::ROLE_EDITOR], 'uses' => 'BanController@edit']);
    $router->post('/update', ['as' => 'bans.update', 'middleware' => ['auth', 'role:' . User::ROLE_EDITOR], 'uses' => 'BanController@update']);
});

// пользователи
$router->group(['prefix' => 'users', 'middleware' => ['auth', 'role:' . User::ROLE_ADMIN]], function () use ($router) {
    $router->get('/', ['as' => 'users', 'uses' => 'UserController@index']);
    $router->get('/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
    $router->get('/edit/{id}', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    $router->get('/delete/{id}', ['as' => 'users.delete', 'uses' => 'UserController@delete']);
    $router->get('/{id}', ['as' => 'users.show', 'uses' => 'UserController@show']);
    $router->post('/store', ['as' => 'users.store', 'uses' => 'UserController@store']);
});

// привилегии
$router->group(['prefix' => 'privileges', 'middleware' => ['auth', 'role:' . User::ROLE_ADMIN]], function () use ($router) {
    $router->get('/', ['as' => 'privileges', 'uses' => 'PrivilegeController@index']);
    $router->get('/create', ['as' => 'privileges.create', 'uses' => 'PrivilegeController@create']);
    $router->get('/edit/{id}', ['as' => 'privileges.edit', 'uses' => 'PrivilegeController@edit']);
    $router->post('/store', ['as' => 'privileges.store', 'uses' => 'PrivilegeController@store']);
});
$router->group(['prefix' => 'privileges'], function () use ($router) {
    $router->get('/buy', ['as' => 'privilege.buy', 'uses' => 'PrivilegeController@buy']);
    $router->get('/{id}', ['as' => 'privileges.show', 'uses' => 'PrivilegeController@show']);
    $router->post('/server/{id}', 'PrivilegeController@server');
    $router->post('/{id}/terms', 'PrivilegeController@privilege');
});

// сервера
$router->group(['prefix' => 'servers', 'middleware' => ['auth', 'role:' . User::ROLE_ADMIN]], function () use ($router) {
    $router->post('servers/store', ['as' => 'servers.store', 'uses' => 'ServerController@store']);
    $router->get('servers/edit/{id}', ['as' => 'servers.edit', 'uses' => 'ServerController@edit']);
});
$router->group(['prefix' => 'servers'], function () use ($router) {
    $router->get('/', ['as' => 'servers', 'uses' => 'ServerController@index']);
    $router->get('/{id}', ['as' => 'server.show', 'uses' => 'ServerController@show']);
});

// пожертвования
$router->get('donations', ['as' => 'donations', 'uses' => 'SiteController@donations']);
