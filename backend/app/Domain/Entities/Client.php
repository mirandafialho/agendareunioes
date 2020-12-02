<?php

namespace app\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Client.
 *
 * @package namespace app\Domain\Entities;
 */
class Client extends Model 
{
	use SoftDeletes;
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'clients';
	
}
