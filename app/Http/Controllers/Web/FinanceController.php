<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $token = request()->session()->get('token');

        $originalRequest = request()->instance();

        $request = Request::create('/api/user/profile', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        $userData = json_decode($response->getContent(), true)['userData'];

        //Ahora hace una petición API /api/income para obtener los ingresos
        $request = Request::create('/api/income', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        //Lo añade a la variable userData dentro del array userData en una key llamada income
        $userData['income'] = json_decode($response->getContent(), true)['total'];

        //Ahora hace una petición API /api/expenses para obtener los gastos
        $request = Request::create('/api/expenses', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        //Lo añade a la variable userData dentro del array userData en una key llamada expenses
        $userData['expenses'] = json_decode($response->getContent(), true)['total'];
        $userData['flexible'] = $userData['income'] - $userData['expenses'];
        app()->instance('request', $originalRequest);

        return view('finanzas.index', ['data' => $userData]);
    }

    public function income()
    {
        $token = request()->session()->get('token');

        $originalRequest = request()->instance();

        $request = Request::create('/api/income', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        //Lo añade a la variable userData dentro del array userData en una key llamada income
        $userData['income'] = json_decode($response->getContent(), true);

        app()->instance('request', $originalRequest);

        return view('finanzas.ingresos', ['data' => $userData]);
    }

    public function expenses()
    {
        return view('finanzas.gastos');
    }

    public function history()
    {
        return view('finanzas.historial');
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
