<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = request()->session()->get('token');

        $originalRequest = request()->instance();

        $request = Request::create('/api/purchases', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);

        $data = json_decode($response->getContent(), true);
        //Por cada compra calcula cuanto dinero costará llegar a la meta (amount/meses)

        foreach ($data as $key => $value) {
            try {
                $data[$key]['period'] = date('Y-m-d', strtotime($value['period']));
                //Si el periodo es de algún mes siguiente al actual, calcula el coste mensual
                if (date('Y-m', strtotime($data[$key]['period'])) >= date('Y-m')) {
                    $diff = date_diff(date_create($data[$key]['period']), date_create(date('Y-m-01')));
                    $months = $diff->format('%m');
                    $data[$key]['cost'] = $value['amount'] / $months;
                } else {
                    //Borra la compra si el periodo es de meses anteriores
                    unset($data[$key]);
                }
            } catch (\Throwable $th) {

            }
        }

        app()->instance('request', $originalRequest);

        return view('finanzas.comprasgrandes', ['data' => $data]);
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
