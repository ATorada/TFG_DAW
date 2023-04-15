<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCookieAndLogin
{
    //Se encarga de revisar que exista la cookie cookie_token, si es así continua con la petición
    //Si no existe la cookie, redirige al login
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->headers->has('cookie')) {
            // Obtener el valor de la cabecera de la solicitud
            $cookieHeader = $request->header('cookie');

            // Buscar el valor de la cookie en la cabecera de la solicitud
            preg_match('/cookie_token=([^;]+)/', $cookieHeader, $matches);

            if (count($matches) === 0) {
                return redirect()->route('loginForm');
            }
            //Convierte el %7 en |
            $token = str_replace('%7C', '|', $matches[1]);
            $request->session()->put('token', $token);
        }
        return $next($request);
    }
}
