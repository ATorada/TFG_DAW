<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lista todas las purchases del usuario
        $purchases = Purchase::where('id_user', auth()->user()->id)->get();
        return response()->json($purchases, 200);
    }

    /**
     * Store a newly created resource in storage.
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
            $request->file('image')->storeAs('public/purchases/purchase_'. $purchase->id.'.png');
        }

        return response()->json($purchase, 201);
    }

    /**
     * Display the specified resource.
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Elimina una purchase
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
