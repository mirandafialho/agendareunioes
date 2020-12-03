<?php

namespace App\Domain\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Domain\Entities\Collaborator;

/**
 * Interface ICollaboratorService.
 *
 * @package namespace App\Domain\Interfaces;
 */
interface ICollaboratorService 
{
	public function all(): Collection;
	public function one($id): Collaborator;
	public function save($id = null, array $data): Collaborator;
	public function delete($id): Collaborator;
} 
