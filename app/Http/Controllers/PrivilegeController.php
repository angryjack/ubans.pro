<?php

namespace App\Http\Controllers;

use App\Models\Privilege;
use App\Services\PrivilegeService;
use App\Services\ServerService;
use Illuminate\Http\Request;
use Michelf\Markdown;
use Laravel\Lumen\Routing\Controller;

class PrivilegeController extends Controller
{
    /**
     * @var PrivilegeService
     */
    private $privilegeService;
    /**
     * @var ServerService
     */
    private $serverService;

    public function __construct(PrivilegeService $privilegeService, ServerService $serverService)
    {
        $this->privilegeService = $privilegeService;
        $this->serverService = $serverService;
    }

    public function index(Request $request)
    {
        $list = $this->privilegeService->search($request);
        return view('privilege.index', compact('list'));
    }

    public function show($id)
    {
        $model = $this->privilegeService->getById($id);
        return view('privilege.show', compact('model'));
    }

    public function create()
    {
        $model = new Privilege();
        $servers = $this->serverService->get();
        return view('privilege.create', compact('model', 'servers'));
    }

    public function edit($id)
    {
        $model = $this->privilegeService->getById($id);
        $servers = $this->serverService->get();
        return view('privilege.edit', compact('model', 'servers'));
    }

    public function store(Request $request)
    {
        $model = $this->privilegeService->store($request);
        return redirect()->route('privileges.show', ['id' => $model->id]);
    }

    public function buy()
    {
        $servers = $this->serverService->getAllWithPrivileges();
        return view('privilege.buy', compact('servers'));
    }

    public function server($id)
    {
        $server = $this->serverService->getByIdWithPrivileges($id);
        //fixme
        $server->description = Markdown::defaultTransform($server->description);
        return response()->json(compact('server'));
    }

    public function privilege($id)
    {
        //todo выпилить, обрабатывать на фронте пришедшую ранее информацию.
        $privilege = $this->privilegeService->getById($id);
        //fixme
        $content = Markdown::defaultTransform($privilege->description);
        $terms = $privilege->rates;

        return response()->json(['terms' => $terms, 'content' => $content]);
    }
}
