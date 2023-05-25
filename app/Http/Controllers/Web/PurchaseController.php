<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Se encarga de mostrar la vista de compras grandes
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //Obtiene el token de la sesión
        $token = request()->session()->get('token');

        $originalRequest = request()->instance();

        //Obtiene los datos de las compras grandes
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

        //Retoma la request original
        app()->instance('request', $originalRequest);

        return view('finanzas.comprasgrandes', ['data' => $data]);
    }
}
