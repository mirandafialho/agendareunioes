<?php

namespace App\Http\Controllers;

use App\Domain\Services\HolidayService;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * @var HolidayService
     */
    protected $holiday_services;

    /**
     * HolidayService constructor.
     *
     * @param HolidayService $clientservice
     */
    public function __construct(HolidayService $holiday_services)
    {
        $this->holiday_services = $holiday_services;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays = $this->holiday_services->all();
        return response()->json($holidays);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $holiday = $this->holiday_services->save([
            'title' => $request->title,
            'description' => $request->description,
            'holiday' => $request->holiday
        ]);

        return response()->json($holiday);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $holiday = $this->holiday_services->one($id);
        return response()->json($holiday);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $holiday = $this->holiday_services->save($id, [
            'title' => $request->title,
            'description' => $request->description,
            'holiday' => $request->holiday
        ]);

        return response()->json($holiday);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $holiday = $this->holiday_services->delete($id);
        return response()->json($holiday);
    }
}
