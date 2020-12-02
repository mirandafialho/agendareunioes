<?php

namespace app\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Collaborator.
 *
 * @package namespace app\Domain\Entities;
 */
class Collaborator extends Model 
{
	use SoftDeletes;
	
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'collaborators';

	
}
