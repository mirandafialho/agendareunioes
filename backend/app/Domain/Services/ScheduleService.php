<?php

namespace app\Domain\Services;

use Illuminate\Database\Eloquent\Collection;
use app\Domain\Entities\Schedule;

class ScheduleService implements IScheduleService 
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function all(): Collection
    {
        return Schedule::all();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function one($id): Schedule
    {
        return Schedule::findOrFail($id);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function save($id = null, array $data): Schedule
    {
        return Schedule::updateOrCreate([
            'id' => $id
        ], $data);
    }
}
