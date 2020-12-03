<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Holiday.
 *
 * @package namespace app\Domain\Entities;
 */
class Holiday extends Model 
{
	use SoftDeletes;
	
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'holidays';

	
}
