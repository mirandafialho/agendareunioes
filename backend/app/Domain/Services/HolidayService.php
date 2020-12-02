<?php

namespace app\Domain\Services;

use Illuminate\Database\Eloquent\Collection;
use app\Domain\Entities\Holiday;

class HolidayService implements IHolidayService 
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function all(): Collection
    {
        return Holiday::all();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function one($id): Holiday
    {
        return Holiday::findOrFail($id);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function save($id = null, array $data): Holiday
    {
        return Holiday::updateOrCreate([
            'id' => $id
        ], $data);
    }
}
