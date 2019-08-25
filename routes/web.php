<?php

$router->get('signin', ['as' => 'signin', 'uses' => 'SiteController@signinPage']);
$router->post('signin', ['as' => 'signin', 'uses' => 'SiteController@signin']);
$router->get('signout', ['as' => 'signout', 'uses' => 'SiteController@signout']);
$router->get('signup', ['as' => 'signup', 'uses' => 'SiteController@signupPage']);
$router->post('signup', ['as' => 'signup', 'uses' => 'SiteController@signup']);

$router->get('/', ['as' => 'home', 'uses' => 'SiteController@index']);

// авторизация по уникальной ссылке
$router->get('profile/auth', 'SiteController@auth');

$router->group(['prefix' => 'profile', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/', ['as' => 'profile', 'uses' => 'UserController@profile']);
    $router->post('/update', ['as' => 'profile.update', 'uses' => 'UserController@updateProfile']);
});

$router->group(['prefix' => 'payment'], function () use ($router) {
    $router->get('/', ['as' => 'payment', 'uses' => 'PaymentController@handle']);
    $router->get('/privilege', ['as' => 'payment.privilege', 'uses' => 'PaymentController@privilege']);
    $router->get('/result', 'PaymentController@showResult');
    $router->post('/go/privilege', 'PaymentController@goPrivilege');
    $router->post('/donation', ['as' => 'payment.donation', 'uses' => 'PaymentController@donation']);
});

$router->group(['prefix' => 'bans'], function () use ($router) {
    $router->get('/', ['as' => 'bans', 'uses' => 'BanController@index']);
    $router->get('/{id}', ['as' => 'bans.show', 'uses' => 'BanController@show']);
    $router->get('/edit/{id}', [
        'as' => 'bans.edit',
        'middleware' => ['auth' ,'role:'. \App\Models\User::ROLE_EDITOR],
        'uses' => 'BanController@edit'
    ]);
    $router->post('/update', [
        'as' => 'bans.update',
        'middleware' => ['auth' ,'role:'. \App\Models\User::ROLE_EDITOR],
        'uses' => 'BanController@update'
        ]);
});

$router->group(['prefix' => 'users', 'middleware' => ['auth', 'role:' . \App\Models\User::ROLE_ADMIN]], function () use ($router) {
    $router->get('/', ['as' => 'users', 'uses' => 'UserController@index']);
    $router->get('/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
    $router->get('/edit/{id}', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    $router->get('/delete/{id}', ['as' => 'users.delete', 'uses' => 'UserController@delete']);
    $router->get('/{id}', ['as' => 'users.show', 'uses' => 'UserController@show']);
    $router->post('/store', ['as' => 'users.store', 'uses' => 'UserController@store']);
});

// управление привилегиями
$router->group(['prefix' => 'privileges', 'middleware' => ['auth', 'role:' . \App\Models\User::ROLE_ADMIN]], function () use ($router) {
    $router->get('/', ['as' => 'privileges', 'uses' => 'PrivilegeController@index']);
    $router->get('/create', ['as' => 'privileges.create', 'uses' => 'PrivilegeController@create']);
    $router->get('/edit/{id}', ['as' => 'privileges.edit', 'uses' => 'PrivilegeController@edit']);
    $router->get('/{id}', ['as' => 'privileges.show', 'uses' => 'PrivilegeController@show']);
    $router->post('/store', ['as' => 'privileges.store', 'uses' => 'PrivilegeController@store']);
});

$router->group(['prefix' => 'privileges'], function () use ($router) {
    $router->post('/server/{id}', 'PrivilegeController@server');
    $router->post('/{id}/terms', 'PrivilegeController@privilege');
});

$router->get('servers', 'ServerController@index');
$router->get('servers/{id}', 'ServerController@show');

$router->get('donations', ['as' => 'donations', 'uses' => 'SiteController@donations']);

$router->get('migrate', 'SiteController@migrate');
