<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    /**
     * Se encarga de mostrar la vista de editar perfil
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function account()
    {
        //Obtiene el token de la sesión
        $token = request()->session()->get('token');

        $originalRequest = request()->instance();

        //Obtiene el perfil
        $request = Request::create('/api/user/profile', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        $userData = json_decode($response->getContent(), true)['userData'];

        //Retoma la request original
        app()->instance('request', $originalRequest);

        return view('finanzas.account', ['data' => $userData]);
    }

    /**
     * Se encarga de cerrar la sesión
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function logout()
    {
        //Hace una peticion a la api para el logout
        $request = Request::create('/api/logout', 'POST');
        $response = app()->handle($request);

        Cookie::queue(Cookie::forget('cookie_token'));
        session()->flush();
        return redirect()->route('loginForm');
    }
}
