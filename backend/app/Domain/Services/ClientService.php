<?php

namespace app\Domain\Services;

use Illuminate\Database\Eloquent\Collection;
use app\Domain\Entities\Client;

class ClientService implements IClientService 
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function all(): Collection
    {
        return Client::all();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function one($id): Client
    {
        return Client::findOrFail($id);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function save($id = null, array $data): Client
    {
        return Client::updateOrCreate([
            'id' => $id
        ], $data);
    }

    /**
     * Scope a query to only include active clients.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
