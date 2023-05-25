<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HouseholdController extends Controller
{
    /**
     * Se encarga de mostrar la vista de unidad familiar
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //Obtiene el token de la sesión
        $token = request()->session()->get('token');

        $originalRequest = request()->instance();

        //Obtiene los datos de la unidad familiar
        $request = Request::create('/api/user/household', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        $data = json_decode($response->getContent(), true);

        //Si no hay error, pide el balance y los miembros
        if (!isset($data['error'])) {
            //Obtiene el balance
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

        //Retoma la request original
        app()->instance('request', $originalRequest);

        return view('finanzas.unidadfamiliar', ['data' => $data]);
    }
}
