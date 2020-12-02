<?php

namespace app\Domain\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use app\Domain\Entities\Schedule;

/**
 * Interface IScheduleService.
 *
 * @package namespace App\Domain\Interfaces;
 */
interface IScheduleService 
{
	public function all(): Collection;
	public function one($id = null): Schedule;
	public function save($id = null, array $data): Schedule;
} 
