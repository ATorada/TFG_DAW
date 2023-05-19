<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function update(Request $request)
    {
        $id = $request->user()->id;


        $validatedData = $request->validate([
            'user' => 'sometimes|max:15|unique:users|min:3',
            'email' => 'sometimes|email|unique:users',
            'password' => 'sometimes|confirmed',
            'id_household' => 'sometimes|exists:households,id',
            'image' => 'sometimes|image|mimes:png',
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

            if($request->password){
                $user->password = $validatedData['password'];
                $user->save();
            }

            if($request->image){
                if (file_exists(storage_path('app/public/users/' . $user->id . '.png'))) {
                    unlink(storage_path('app/public/users/' . $user->id . '.png'));
                }
                $request->image->storeAs('public/users/', $user->id . '.png');
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

    public function leaveHousehold(Request $request)
    {
        $user = User::find($request->user()->id);
        if ($user) {
            if ($user->id_household) {
                $user->id_household = null;
                $user->save();
                return response()->json(['message' => 'User left household'], 200);
            } else {
                return response()->json(['error' => 'User not in a household'], 404);
            }
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function userProfile()
    {
        return response()->json([
            "userData" => auth()->user()
        ], Response::HTTP_OK);
    }

    // Posible in the future
    public function destroy(string $id)
    {
        //
    }
}
