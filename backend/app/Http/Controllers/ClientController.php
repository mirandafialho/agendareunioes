<?php

namespace App\Http\Controllers;

use App\Domain\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @var ClientService
     */
    protected $client_service;

    /**
     * ClientService constructor.
     *
     * @param ClientService $clientservice
     */
    public function __construct(ClientService $client_service)
    {
        $this->client_service = $client_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->client_service->all();
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = $this->client_service->save([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cellphone' => $request->cellphone,
            'active' => $request->active
        ]);

        return response()->json($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->client_service->one($id);
        return response()->json($client);
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
        $client = $this->client_service->save($id, [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cellphone' => $request->cellphone,
            'active' => $request->active
        ]);

        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = $this->client_service->delete($id);
        return response()->json($client);
    }
}
