<?php

namespace app\Domain\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use app\Domain\Entities\Collaborator;

/**
 * Interface ICollaboratorService.
 *
 * @package namespace App\Domain\Interfaces;
 */
interface ICollaboratorService 
{
	public function all(): Collection;
	public function one($id = null): Collaborator;
	public function save($id = null, array $data): Collaborator;
} 
