<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class FinanceController extends Controller
{
    /**
     * Se encarga de mostrar la vista de finanzas
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //Obtiene el token de la sesión y realiza las peticiones pertinentes
        $token = request()->session()->get('token');

        $originalRequest = request()->instance();

        //Obtiene el perfil
        $request = Request::create('/api/user/profile', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        $userData = json_decode($response->getContent(), true)['userData'];

        //Obtiene sus ingresos
        $request = Request::create('/api/income', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        $incomes = json_decode($response->getContent(), true)['income'];

        //Recorre incomes y suma a $userData['income'] todos los ingresos de este mes y año
        $userData['income'] = 0;
        foreach ($incomes as $key => $value) {
            if (date('Y-m', strtotime($value['period'])) == date('Y-m')) {
                $userData['income'] += $value['amount'];
            }
        }

        //Obtiene sus gastos
        $request = Request::create('/api/expenses', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        $expenses = json_decode($response->getContent(), true)['expenses'];

        //Recorre expenses y suma a $userData['expenses'] todos los gastos de este mes y año
        $userData['expenses'] = 0;
        foreach ($expenses as $key => $value) {
            if (date('Y-m', strtotime($value['period'])) == date('Y-m')) {
                $userData['expenses'] += $value['amount'];
            }
        }
        $userData['flexible'] = $userData['income'] - $userData['expenses'];

        //Retoma la request original
        app()->instance('request', $originalRequest);


        return view('finanzas.index', ['data' => $userData]);
    }

    /**
     * Muestra la vista de ingresos
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function income()
    {
        //Obtiene el token de la sesión y realiza las peticiones pertinentes
        $token = request()->session()->get('token');

        $originalRequest = request()->instance();

        //Obtiene los ingresos
        $request = Request::create('/api/income', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        $data = json_decode($response->getContent(), true);

        //Elimina los ingresos que no sean de este mes y año
        foreach ($data['income'] as $key => $income) {
            if (date('Y-m', strtotime($income['period'])) != date('Y-m')) {
                unset($data['income'][$key]);
            }
        }

        //Retoma la request original
        app()->instance('request', $originalRequest);

        return view('finanzas.ingresos', ['data' => $data]);
    }

    /**
     * Muestra la vista de gastos
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function expenses()
    {
        //Obtiene el token de la sesión y realiza las peticiones pertinentes
        $token = request()->session()->get('token');

        $originalRequest = request()->instance();

        //Obtiene los ingresos
        $request = Request::create('/api/income', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        $income = json_decode($response->getContent(), true);
        $income['total'] = 0;

        //Elimina los ingresos que no sean de este mes y año
        foreach ($income['income'] as $key => $value) {
            if (date('Y-m', strtotime($value['period'])) != date('Y-m')) {
                unset($income[$key]);
            } else {
                $income['total'] += $value['amount'];
            }
        }

        //Obtiene los gastos
        $request = Request::create('/api/expenses', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        $data = json_decode($response->getContent(), true);

        //Elimina los gastos que no sean de este mes y año
        $data['total'] = 0;
        foreach ($data['expenses'] as $key => $expense) {
            if (date('Y-m', strtotime($expense['period'])) != date('Y-m')) {
                unset($data['expenses'][$key]);
            } else {
                $data['total'] += $expense['amount'];
            }
        }

        //Busca el gasto ahorro, en caso de que exista lo quita de expenses y lo añade a ahorro
        foreach ($data['expenses'] as $key => $expense) {
            if ($expense['name'] == 'ahorro') {
                $data['ahorro'] = $expense['amount'];
                $data['ahorro_id'] = $expense['id'];
                unset($data['expenses'][$key]);
            }
        }
        //Si no existe el gasto ahorro, lo crea con 0
        if (!isset($data['ahorro'])) {
            $data['ahorro'] = 0;
            $data['ahorro_id'] = 0;
        }

        //Se calcula el gasto flexible
        $data['flexible'] = $income['total'] - $data['total'];

        //Se añade el ingreso total
        if ($income['total'] > 0) {
            $data['income'] = $income['total'];
        }

        //Retoma la request original
        app()->instance('request', $originalRequest);

        return view('finanzas.gastos', ['data' => $data]);
    }

    /**
     * Muestra la vista de historial
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function history()
    {
        //Obtiene el token de la sesión y realiza las peticiones pertinentes
        $token = request()->session()->get('token');

        $originalRequest = request()->instance();

        //Obtiene los ingresos
        $request = Request::create('/api/income', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        $income = json_decode($response->getContent(), true)['income'];

        //Obtiene los gastos
        $request = Request::create('/api/expenses', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = app()->handle($request);
        $expenses = json_decode($response->getContent(), true)['expenses'];

        //Los une y ordena por fecha
        $data = array_merge($income, $expenses);
        usort($data, function ($a, $b) {
            return strtotime($a['period']) - strtotime($b['period']);
        });

        //Formatea la fecha
        foreach ($data as $key => $value) {
            $data[$key]['period'] = date('d-m-Y', strtotime($value['period']));
        }

        //Retoma la request original
        app()->instance('request', $originalRequest);

        return view('finanzas.historial', ['data' => $data]);
    }
}
