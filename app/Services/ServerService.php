<?php

namespace App\Services;

use App\Models\Server;
use xPaw\SourceQuery\SourceQuery;

class ServerService
{
    /**
     * @var SourceQuery
     */
    private $sourceQuery;

    public function __construct(SourceQuery $sourceQuery)
    {
        $this->sourceQuery = $sourceQuery;
    }

    public function get()
    {
        return Server::get()->keyBy('id');
    }

    public function getById($id): Server
    {
        return Server::findOrFail($id);
    }

    public function getWithPrivileges()
    {
        return Server::with('privileges.rates')->get()->keyBy('id');
    }

    public function getWithInformation()
    {
        $servers = $this->get();

        foreach ($servers as $index => $server) {
            $queryResult = $this->getSourceQueryInformation($server);

            $server->players = $queryResult['players'];
            $server->info = $queryResult['info'];
        }

        return $servers;
    }

    public function getSourceQueryInformation(Server $server)
    {
        $info = $players = [];
        try {
            $this->sourceQuery->Connect(
                $this->getServerIp($server),
                $this->getPort($server),
                1,
                $this->sourceQuery::GOLDSOURCE
            );
            $info = $this->sourceQuery->GetInfo();
            $players = $this->sourceQuery->GetPlayers();
        } catch (Exception $e) {
            // игнорируем ошибки
        } finally {
            $this->sourceQuery->Disconnect();
        }
        return ['info' => $info, 'players' => $players];
    }

    /**
     * Возвращает IP адрес сервера.
     *
     * @param Server $server
     * @return mixed
     */
    private function getServerIp(Server $server)
    {
        $ip = '';
        if (strpos($server->address, ':')) {
            $ip = explode(':', $server->address)[0];
        }
        return $ip;
    }
    /**
     * Возвращает порт сервера.
     *
     * @param Server $server
     * @return mixed
     */
    private function getPort(Server $server)
    {
        $port = '';
        if (strpos($server->address, ':')) {
            $port = explode(':', $server->address)[1];
        }
        return $port;
    }
}
