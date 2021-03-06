<?php

namespace App\Http\Controllers;

use App\Domain\Services\ScheduleService;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $start = Carbon::createFromFormat('Y-m-d H:i:s', $request->start);
        $end = Carbon::createFromFormat('Y-m-d H:i:s', $request->end);

        $schedule = $this->schedule_services->save($request->id, [
            'start' => $request->start,
            'end' => $request->end,
            'duration' => $end->diffInHours($start) . ':' . $end->diffInMinutes($start) . ':00',
            'title' => $request->title,
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
        
        $schedule['start'] = Carbon::createFromFormat(
            'Y-m-d H:i:s', 
            $schedule['start']
        )->format('d/m/Y H:i');
        $schedule['end'] = Carbon::createFromFormat(
            'Y-m-d H:i:s', 
            $schedule['end']
        )->format('d/m/Y H:i');
        $schedule['duration'] = Carbon::createFromFormat(
            'H:i:s', 
            $schedule['duration']
        )->format('H:i');

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
            'start' => $request->start,
            'end' => $request->end,
            'duration' => $request->duration,
            'title' => $request->title,
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
