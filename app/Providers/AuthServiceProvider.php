<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function ($request) {

            $token = $request->cookie('token');

            if (!$token) {
                return null;
            }
            try {
                $credentials = JWT::decode($token, env('APP_KEY'), ['HS256']);
            } catch (ExpiredException $e) {
                return null;
            }

            return User::find($credentials->sub);
        });
    }
}
