<?php

namespace App\Http\Controllers;

use App\Domain\Services\CollaboratorService;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    /**
     * @var ClientService
     */
    protected $collaborator_service;

    /**
     * ClientService constructor.
     *
     * @param ClientService $clientservice
     */
    public function __construct(CollaboratorService $collaborator_service)
    {
        $this->collaborator_service = $collaborator_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collaborators = $this->collaborator_service->all();
        return response()->json($collaborators);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collaborator = $this->collaborator_service->save([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cellphone' => $request->cellphone,
            'user_id' => $request->user_id,
            'partner' => $request->partner,
            'active' => $request->active
        ]);

        return response()->json($collaborator);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collaborator = $this->collaborator_service->one($id);
        return response()->json($collaborator);
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
        $collaborator = $this->collaborator_service->save($id, [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cellphone' => $request->cellphone,
            'user_id' => $request->user_id,
            'partner' => $request->partner,
            'active' => $request->active
        ]);

        return response()->json($collaborator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collaborator = $this->collaborator_service->delete($id);
        return response()->json($collaborator);
    }
}
