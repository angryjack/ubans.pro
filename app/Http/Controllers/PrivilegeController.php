<?php

namespace App\Http\Controllers;

use App\Models\Privilege;
use App\Services\PrivilegeService;
use App\Services\ServerService;
use Illuminate\Http\Request;

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

    public function server($id)
    {
        $server = $this->serverService->getById($id);
        $content = $server->description;
        $privileges = $this->privilegeService->getServerPrivileges($server);

        return response()->json(['privileges' => $privileges, 'content' => $content]);
    }

    public function privilege($id)
    {
        $privilege = $this->privilegeService->getById($id);
        $content = $privilege->description;
        $terms = $this->privilegeService->getRates($privilege);

        return response()->json(['terms' => $terms, 'content' => $content]);
    }
}
