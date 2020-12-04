<?php

namespace App\Http\Controllers;

use App\Domain\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * @var ScheduleService
     */
    protected $schedule_services;

    /**
     * ScheduleService constructor.
     *
     * @param ScheduleService $clientservice
     */
    public function __construct(ScheduleService $schedule_services)
    {
        $this->schedule_services = $schedule_services;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = $this->schedule_services->all();
        return response()->json($schedules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schedule = $this->schedule_services->save([
            'beginning_date' => $request->beginning_date,
            'conclusion_date' => $request->conclusion_date,
            'duration' => $request->duration,
            'description' => $request->description,
            'guest_client_id' => $request->guest_client_id,
            'guest_collaborator_id' => $request->guest_collaborator_id,
            'requester_client_id' => $request->requester_client_id,
            'requester_collaborator_id' => $request->requester_collaborator_id,
            'accept' => $request->accept
        ]);

        return response()->json($schedule);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = $this->schedule_services->one($id);
        return response()->json($schedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $schedule = $this->schedule_services->save($id, [
            'beginning_date' => $request->beginning_date,
            'conclusion_date' => $request->conclusion_date,
            'duration' => $request->duration,
            'description' => $request->description,
            'guest_client_id' => $request->guest_client_id,
            'guest_collaborator_id' => $request->guest_collaborator_id,
            'requester_client_id' => $request->requester_client_id,
            'requester_collaborator_id' => $request->requester_collaborator_id,
            'accept' => $request->accept
        ]);

        return response()->json($schedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = $this->schedule_services->delete($id);
        return response()->json($schedule);
    }
}