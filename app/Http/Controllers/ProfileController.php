<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile()
    {
        $model = $this->userService->getUserByAuth();
        if ($model === null) {
            throw new NotFoundHttpException('Необходимо авторизоваться.');
        }

        return view('profile.show', compact('model'));
    }

    public function updateProfile(Request $request)
    {
        $model = $this->userService->updateProfile($request);
        return view('profile.show', compact('model'));
    }

}
