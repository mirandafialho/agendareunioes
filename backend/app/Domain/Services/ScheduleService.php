<?php

namespace App\Domain\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Domain\Interfaces\IScheduleService;
use App\Domain\Entities\Schedule;

class ScheduleService implements IScheduleService 
{
    /**
     * Collection de agendas.
     */
    public function all(): Collection
    {
        return Schedule::all();
    }

    /**
     * Retorna um registro de agenda.
     *
     * @var integer $id
     * @return Schedule
     */
    public function one($id): Schedule
    {
        return Schedule::findOrFail($id);
    }

    /**
     * Deletar um registro de agenda.
     *
     * @var integer $id
     * @return bool
     */
    public function delete($id): bool
    {
        $schedule = Schedule::findOrFail($id);
        return $schedule->delete();
    }

    /**
     * Salvar agenda.
     *
     * @var integer $id
     * @var array $data
     * @return Schedule
     */
    public function save($id = null, array $data): Schedule
    {
        return Schedule::updateOrCreate([
            'id' => $id
        ], $data);
    }
}
