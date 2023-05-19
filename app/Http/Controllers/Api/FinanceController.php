<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $user = auth()->user();
        $finances = Finance::where('id_user', $user->id)->get();
        return response()->json($finances, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'category' => 'nullable|string|in:otros,alimentacion,vivienda,transporte,comunicaciones,ocio,salud,educacion,ahorro',
            'amount' => 'required|numeric|min:0',
            'constant' => 'boolean',
            'is_income' => 'boolean',
            'compute_household' => 'boolean',
        ]);

        $validatedData['constant'] = $validatedData['constant'] ?? 0;
        $validatedData['is_income'] = $validatedData['is_income'] ?? 0;
        $validatedData['compute_household'] = $validatedData['compute_household'] ?? 0;

        $user = auth()->user();
        $finance = new Finance();
        $finance->id_user = $user->id;
        $finance->name = $request->name;
        $finance->period = date('Y-m-d');
        $finance->category = $request->category;
        $finance->amount = $request->amount;
        $finance->constant = $validatedData['constant'];
        $finance->is_income = $validatedData['is_income'];
        $finance->compute_household = $validatedData['compute_household'];

        try {
            $finance->save();
        } catch (\Illuminate\Database\QueryException $e) {

            $error = $e->errorInfo[1];
            if ($error == 1644) {
                if (strpos($e->getMessage(), 'gasto') || strpos($e->getMessage(), 'ingreso') !== false) {
                    if (strpos($e->getMessage(), 'de tipo ahorro') !== false) {
                        return response()->json(['error' => 'The category or name "ahorro" is only allowed in the expenses section with the category "ahorro".'], 400);
                    } else {
                        return response()->json(['error' => 'The category cannot be null if it is an expense.'], 400);
                    }
                }
            }
            return response()->json(['error' => 'A finance with the same name and period already exists.'], 400);
        }

        return response()->json($finance, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        $user = auth()->user();
        $finance = Finance::where('id_user', $user->id)->where('id', $id)->first();
        if ($finance) {
            return response()->json($finance, 200);
        } else {
            return response()->json(['error' => 'Finance not found.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:50',
            'period' => 'sometimes|date',
            'category' => 'nullable|string|in:otros,alimentacion,vivienda,transporte,comunicaciones,ocio,salud,educacion,ahorro',
            'amount' => 'sometimes|numeric',
            'constant' => 'sometimes|boolean',
            'is_income' => 'sometimes|boolean',
            'compute_household' => 'sometimes|boolean',
            'id_household' => 'nullable|exists:households,id',
        ]);

        $user = auth()->user();
        $finance = Finance::where('id_user', $user->id)->where('id', $id)->first();

        if (!$finance) {
            return response()->json(['error' => 'Finance not found.'], 404);
        }

        try {
            $finance->update($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {

            $error = $e->errorInfo[1];
            if ($error == 1062) {
                return response()->json(['error' => 'A finance with the same name and period already exists.'], 400);
            } else if ($error == 1452) {
                return response()->json(['error' => 'The household does not exist.'], 400);
            } else if ($error == 1644) {
                if (strpos($e->getMessage(), 'gasto') !== false || strpos($e->getMessage(), 'ingreso') !== false) {
                    if (strpos($e->getMessage(), 'de tipo ahorro') !== false) {
                        return response()->json(['error' => 'The category or name "ahorro" is only allowed in the expenses section with the category "ahorro".'], 400);
                    } else {
                        return response()->json(['error' => 'The category cannot be null if it is an expense.'], 400);
                    }
                }
            }
            return response()->json(['error' => 'The finance could not be updated.', 'message' => $e->getMessage()], 400);
        }

        return response()->json($finance, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $user = auth()->user();
        $finance = Finance::where('id_user', $user->id)->where('id', $id)->first();
        if (!$finance) {
            return response()->json(['error' => 'Finance not found.'], 404);
        }
        try {
            $finance->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'The finance could not be deleted.'], 400);
        }

        return response()->json(null, 204);
    }

    public function getIncome(){
        $user = auth()->user();
        $result = [];
        $total = 0;
        $finances = Finance::where('id_user', $user->id)->where('is_income', 1)->get();
        foreach ($finances as $finance) {
            $total += $finance->amount;
        }
        $result['total'] = $total;
        $result['income'] = $finances;
        return response()->json($result, 200);
    }

    public function getExpenses(){
        $user = auth()->user();
        $result = [];
        $finances = Finance::where('id_user', $user->id)->where('is_income', 0)->get();
        $total = 0;
        foreach ($finances as $finance) {
            $total += $finance->amount;
        }
        $result['total'] = $total;
        $result['expenses'] = $finances;
        return response()->json($result, 200);
    }
}
