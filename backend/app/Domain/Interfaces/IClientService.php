<?php

namespace App\Domain\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Domain\Entities\Client;

/**
 * Interface IClientService.
 *
 * @package namespace App\Domain\Interfaces;
 */
interface IClientService 
{
	public function all(): Collection;
	public function one($id = null): Client;
	public function save($id = null, array $data): Client;
	public function delete($id = null): Client;
} 
