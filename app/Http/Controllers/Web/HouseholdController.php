<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HouseholdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Obtiene el token de la sesión
        $token = request()->session()->get('token');

        //Obtiene la petición original
        $originalRequest = request()->instance();

        //Crea una nueva petición a la API para obtener los datos del usuario
        $request = Request::create('/api/user/household', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);

        $data = json_decode($response->getContent(), true);

        if (!isset($data['error'])){
            //Pide el balance a la api
            $request = Request::create('/api/households/balance', 'GET');
            $request->headers->set('Authorization', 'Bearer ' . $token);
            $response = app()->handle($request);

            $balance = json_decode($response->getContent(), true);
            $data['income'] = $balance['income'];
            $data['expenses'] = $balance['expenses'];

            //Obtiene los members
            $request = Request::create('/api/households/members', 'GET');
            $request->headers->set('Authorization', 'Bearer ' . $token);
            $response = app()->handle($request);

            $data['members'] = json_decode($response->getContent(), true);
        }
        //Vuelve a poner la petición original
        app()->instance('request', $originalRequest);

        return view('finanzas.unidadfamiliar', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
