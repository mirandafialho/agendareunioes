<?php

namespace app\Domain\Services;

use Illuminate\Database\Eloquent\Collection;
use app\Domain\Entities\Collaborator;

class CollaboratorService implements ICollaboratorService 
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function all(): Collection
    {
        return Collaborator::all();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function one($id): Collaborator
    {
        return Collaborator::findOrFail($id);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function save($id = null, array $data): Collaborator
    {
        return Collaborator::updateOrCreate([
            'id' => $id
        ], $data);
    }
}
