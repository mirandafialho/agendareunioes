<?php

namespace App\Domain\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Domain\Interfaces\IScheduleService;
use App\Domain\Entities\Schedule;

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
    public function delete($id): Schedule
    {
        $schedule = Schedule::findOrFail($id);
        return $schedule->delete();
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
