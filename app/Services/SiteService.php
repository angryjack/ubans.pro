<?php

namespace App\Services;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;

class SiteService
{
    public function getSigninCookie(Request $request)
    {
        //todo validate
        $user = User::where('nickname', $request->input('login'))->first();

        if (!$user || md5($request->input('password')) !== $user->password) {
            throw new \Exception('Введен неправильный логин или пароль.');
        }

        return new Cookie('token', $this->jwt($user), '+30 days');
    }

    public function dropUserCookie()
    {
        return new Cookie('token', null);
    }

    /**
     * Create a new token.
     *
     * @return string
     */
    protected function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60 * 60 * 24 * 30 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('APP_KEY'));
    }
}
