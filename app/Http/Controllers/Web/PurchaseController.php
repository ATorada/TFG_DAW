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
                if (!date('Y-m', strtotime($data[$key]['period'])) >= date('Y-m')) {
                    unset($data[$key]);
                } else {
                    $data[$key]['created_at'] = date('Y-m', strtotime($value['created_at']));
                    $data[$key]['period'] = date('Y-m', strtotime($data[$key]['period']));
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
