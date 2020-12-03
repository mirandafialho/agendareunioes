<?php

namespace App\Domain\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use app\Domain\Entities\Holiday;

/**
 * Interface IHolidayService.
 *
 * @package namespace App\Domain\Interfaces;
 */
interface IHolidayService 
{
	public function all(): Collection;
	public function one($id = null): Holiday;
	public function save($id = null, array $data): Holiday;
	public function delete($id): Holiday;
} 
