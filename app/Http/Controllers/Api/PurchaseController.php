<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use Carbon\Carbon;

class PurchaseController extends Controller
{
    /**
     * Se encarga de crear una purchase
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $purchases = Purchase::where('id_user', auth()->user()->id)->get();

        foreach ($purchases as $purchase) {
            //Calcula el coste mensual
            $cost = 0;
            $period =  Carbon::parse(date('Y-m-d', strtotime($purchase['period'])));
            $created_at = Carbon::parse(date('Y-m-1', strtotime($purchase['created_at'])));
            $months = $period->diffInMonths($created_at);
            if ($months == 0) {
                $cost = $purchase['amount'];
            } else {
                $cost = $purchase['amount'] / $months;
            }
            $purchase['cost'] = $cost;

            //Calcula lo que ya ha pagado
            $cost = 0;
            $period = Carbon::parse(date('Y-m-d'));
            $months = $period->diffInMonths($created_at);
            if ($months == 0) {
                $cost = 0;
            } else {
                $cost = $purchase['amount'] - ($purchase['amount'] - ($purchase['cost'] * $months));
            }
            $purchase['payed'] = $cost;
        }
        return response()->json($purchases, 200);
    }

    /**
     * Se encarga de crear una purchase
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'image' => 'sometimes|image|mimes:png',
            'name' => 'required|string|max:50',
            'period' => 'required|date|after_or_equal:' . date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-01')))),
            'amount' => 'required|numeric|min:0|max:99999.99',
        ]);

        $user = auth()->user();
        $purchase = new Purchase();
        $purchase->id_user = $user->id;
        $purchase->name = $request->name;
        $purchase->period = $request->period;
        $purchase->amount = $request->amount;

        try {
            $purchase->save();
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'The maximum number of purchases has been reached. (5)'], 400);
        }

        if ($request->hasFile('image')) {
            $request->file('image')->storeAs('public/purchases/purchase_' . $purchase->id . '.png');
        }

        return response()->json($purchase, 201);
    }

    /**
     * Se encarga de eliminar una purchase
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $purchase = Purchase::where('id_user', auth()->user()->id)->where('id', $id)->first();
        if ($purchase) {
            return response()->json($purchase, 200);
        } else {
            return response()->json(['error' => 'Purchase not found.'], 404);
        }
    }

    /**
     * Se encarga de actualizar una purchase
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:50',
            'period' => 'sometimes|date|after_or_equal:' . date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-01')))),
            'amount' => 'sometimes|numeric|min:0',
        ]);

        $purchase = Purchase::where('id_user', auth()->user()->id)->where('id', $id)->first();
        if ($purchase) {
            try {
                $purchase->update($validatedData);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json(['error' => 'The maximum number of purchases has been reached. (5)'], 400);
            } catch (\Exception $e) {
            }
            return response()->json($purchase, 200);
        } else {
            return response()->json(['error' => 'Purchase not found.'], 404);
        }
    }

    /**
     * Se encarga de eliminar una purchase
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::where('id_user', auth()->user()->id)->where('id', $id)->first();

        //Si existe su imagen la elimina
        if (file_exists(storage_path('app/public/purchases/purchase_' . $id . '.png'))) {
            unlink(storage_path('app/public/purchases/purchase_' . $id . '.png'));
        }
        if ($purchase) {
            $purchase->delete();
            return response()->json(['message' => 'Purchase deleted.'], 204);
        } else {
            return response()->json(['error' => 'Purchase not found.'], 404);
        }
    }
}
