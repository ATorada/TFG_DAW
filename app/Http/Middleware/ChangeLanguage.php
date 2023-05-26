<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeLanguage
{
    public function handle(Request $request, Closure $next): Response
    {
        //Se encarga de obtener el valor de la cookie locale y cambiar el idioma de la aplicación
        if ($request->headers->has('cookie')) {
            $cookieHeader = $request->header('cookie');
            preg_match('/locale=([^;]+)/', $cookieHeader, $matches);
            if (count($matches) === 0) {
                $matches[1] = 'es';
            }
            $request->session()->put('locale', $matches[1]);
            App()->setLocale($matches[1]);
        }
        return $next($request);
    }
}
