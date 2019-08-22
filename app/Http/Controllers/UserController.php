<?php

namespace App\Http\Controllers;

use App\Models\UserForm;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $list = $this->userService->search($request);
        return view('user.index', compact('list'));
    }

    public function show($id)
    {
        $model = $this->userService->getWithServers($id);
        return view('user.show', compact('model' ));
    }

    public function create()
    {
        $form = new UserForm();
        return view('user.create', compact('form'));
    }

    public function edit($id)
    {
        $model = $this->userService->getById($id);
        $form = new UserForm($model);
        return view('user.edit', compact('form'));
    }

    public function store(Request $request)
    {
        $model = $this->userService->store($request);
        return redirect()->route('users.show', ['id' => $model->id]);
    }

    public function delete($id)
    {
        $model = $this->userService->getById($id);
        $this->userService->delete($model);

        return redirect()->route('users');
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
