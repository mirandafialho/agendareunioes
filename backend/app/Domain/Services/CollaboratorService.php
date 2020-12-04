<?php

namespace App\Domain\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Domain\Interfaces\ICollaboratorService;
use App\Domain\Entities\Collaborator;

class CollaboratorService implements ICollaboratorService 
{
    /**
     * Collection de colaboradores.
     */
    public function all(): Collection
    {
        return Collaborator::all();
    }

    /**
     * Retorna um registro de colaborador.
     *
     * @var integer $id
     * @return Collaborator
     */
    public function one($id): Collaborator
    {
        return Collaborator::findOrFail($id);
    }

    /**
     * Deletar um registro de colaborador.
     *
     * @var integer $id
     * @return Collaborator
     */
    public function delete($id): Collaborator
    {
        $collaborator = Collaborator::findOrFail($id);
        return $collaborator->delete();
    }

    /**
     * Salvar colaborador.
     *
     * @var integer $id
     * @var array $data
     * @return Collaborator
     */
    public function save($id = null, array $data): Collaborator
    {
        return Collaborator::updateOrCreate([
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
