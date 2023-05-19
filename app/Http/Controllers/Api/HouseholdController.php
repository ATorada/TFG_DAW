<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Household;

class HouseholdController extends Controller
{

    public function store(Request $request)

    //Crea una transaccion en la que crea un household y lo asocia al usuario
    {
        $household = Household::create();

        $request->user()->id_household = $household->id;
        $request->user()->save();
        $household->save();
        $household = Household::find($household->id);
        return response()->json($household, 200);
    }

    //Método que devuelve el nombre de los usuarios de un household
    public function getMembers()
    {
        $id = auth()->user()->id_household;
        $household = Household::find($id);
        if ($household) {
            $users = $household->users;
            $members = [];
            foreach ($users as $user) {
                $members[] = $user->user;
            }
            return response()->json($members, 200);
        } else {
            return response()->json(['error' => 'You are not in a household'], 404);
        }
    }

    //Obtiene de cada usuario de la household todos los gastos e ingresos y los suma
    public function getBalance()
    {
        $id = auth()->user()->id_household;
        $household = Household::find($id);
        if ($household) {
            $users = $household->users;
            $incomesTotal = 0;
            $expensesTotal = 0;
            foreach ($users as $user) {
                $incomes = $user->finances()->where('compute_household', true)->where('is_income', true)->get();
                //Elimina todos los incomes que no sean de este mes y año
                foreach ($incomes as $key => $value) {
                    if (date('Y-m', strtotime($value['period'])) != date('Y-m')) {
                        unset($incomes[$key]);
                    }
                }
                foreach ($incomes as $income) {
                    $incomesTotal +=  $income->amount;
                }
                $expenses = $user->finances()->where('compute_household', true)->where('is_income', false)->get();
                //Elimina todos los expenses que no sean de este mes y año
                foreach ($expenses as $key => $value) {
                    if (date('Y-m', strtotime($value['period'])) != date('Y-m')) {
                        unset($expenses[$key]);
                    }
                }
                foreach ($expenses as $expense) {
                    $expensesTotal += $expense->amount;
                }
            }
            return response()->json(['income' => $incomesTotal, 'expenses' => $expensesTotal], 200);
        } else {
            return response()->json(['error' => 'Household not found'], 404);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $household = Household::find($id);
        if ($household) {
            $household->delete();
            return response()->json(['message' => 'Household deleted'], 200);
        } else {
            return response()->json(['error' => 'Household not found'], 404);
        }
    }

    public function joinHousehold(Request $request, string $uuid)
    {
        $household = Household::where('uuid', $uuid)->first();
        if ($household) {
            $request->user()->id_household = $household->id;
            $request->user()->save();
            return response()->json(['message' => 'Joined household'], 200);
        } else {
            return response()->json(['error' => 'Household not found'], 404);
        }
    }
}
