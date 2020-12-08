<?php

namespace App\Domain\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Domain\Entities\Schedule;

/**
 * Interface IScheduleService.
 *
 * @package namespace App\Domain\Interfaces;
 */
interface IScheduleService 
{
	public function all(): Collection;
	public function one($id): Schedule;
	public function save($id = null, array $data): Schedule;
	public function delete($id): bool;
} 
