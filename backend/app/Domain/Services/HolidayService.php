<?php

namespace App\Domain\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Domain\Interfaces\IHolidayService;
use App\Domain\Entities\Holiday;

class HolidayService implements IHolidayService 
{
    /**
     * Collection de feriados.
     */
    public function all(): Collection
    {
        return Holiday::all();
    }

    /**
     * Retorna um registro de feriado.
     *
     * @var integer $id
     * @return Holiday
     */
    public function one($id): Holiday
    {
        return Holiday::findOrFail($id);
    }

    /**
     * Deletar um registro de feriado.
     *
     * @var integer $id
     * @return Holiday
     */
    public function delete($id): Holiday
    {
        $holiday = Holiday::findOrFail($id);
        return $holiday->delete();
    }

    /**
     * Salvar feriado.
     *
     * @var integer $id
     * @var array $data
     * @return Holiday
     */
    public function save($id = null, array $data): Holiday
    {
        return Holiday::updateOrCreate([
            'id' => $id
        ], $data);
    }
}
