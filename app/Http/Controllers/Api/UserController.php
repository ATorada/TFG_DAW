<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function update(Request $request, string $id)
    {
        if ($request->user()->id != $id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validatedData = $request->validate([
            'user' => 'sometimes|max:15|unique:users',
            'email' => 'sometimes|email|unique:users',
            'password' => 'sometimes|confirmed',
            'id_household' => 'sometimes|exists:households,id'
        ]);

        if (count($validatedData) <= 0) {
            return response()->json(['error' => 'No data'], 400);
        }

        $user = User::find($id);
        if ($user) {

            if ($request->password) {
                $validatedData['password'] = Hash::make($request->password);
            }

            if ($request->user) {
                $user->user = $validatedData['user'];
                $user->save();
            }

            $user->update($validatedData);
            return response()->json($user, 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }

    }

    public function getHousehold()
    {
        $user = auth()->user();
        if ($user) {
            if ($user->id_household) {
                $uuid = $user->household->uuid;
                return response()->json(['uuid' => $uuid, 'id' => $user->id_household], 200);
            } else {
                return response()->json(['error' => 'User not in a household'], 404);
            }
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    // Posible in the future
    public function destroy(string $id)
    {
        //
    }
}
