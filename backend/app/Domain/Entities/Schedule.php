<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Schedule.
 *
 * @package namespace app\Domain\Entities;
 */
class Schedule extends Model 
{
	use SoftDeletes, HasFactory;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'schedules';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start',
		'end',
		'duration',
		'title',
		'description',
		'guest_client_id',
		'guest_collaborator_id',
		'requester_client_id',
		'requester_collaborator_id',
		'accept'
    ];
}
