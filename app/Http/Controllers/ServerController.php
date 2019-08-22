<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Services\ServerService;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * @var ServerService
     */
    private $serverService;

    public function __construct(ServerService $serverService)
    {
        $this->serverService = $serverService;
    }

    public function index()
    {
        $list = $this->serverService->getWithInformation();

        return view('server.index', compact('list'));
    }

    public function show($id)
    {
        $model = $this->serverService->getById($id);

        return view('server.show', compact('model'));
    }

    public function edit($id)
    {
        $model = $this->serverService->getById($id);

        return view('ban.edit', compact('model'));
    }

    public function update(Request $request)
    {
        $model = $this->serverService->getById($request->input('bid'));
        $this->serverService->update($model, $request);

        return redirect()->route('server.show', ['id' => $model->id]);
    }
}
