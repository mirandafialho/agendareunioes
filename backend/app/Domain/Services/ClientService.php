<?php

namespace App\Domain\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Domain\Interfaces\IClientService;
use App\Domain\Entities\Client;

class ClientService implements IClientService 
{
    /**
     * Collection de clientes.
     */
    public function all(): Collection
    {
        return Client::all();
    }

    /**
     * Retorna um registro de cliente.
     *
     * @var integer $id
     * @return Client
     */
    public function one($id): Client
    {
        return Client::findOrFail($id);
    }

    /**
     * Salvar cliente.
     *
     * @var integer $id
     * @var array $data
     * @return Client
     */
    public function save($id = null, array $data): Client
    {
        return Client::updateOrCreate([
            'id' => $id
        ], $data);
    }

    /**
     * Deletar um registro de cliente.
     *
     * @var integer $id
     * @return bool
     */
    public function delete($id): bool
    {
        $client = Client::findOrFail($id);
        return $client->delete();
    }
}
