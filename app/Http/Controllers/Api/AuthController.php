<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'user' => 'required|max:15|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        $user->user = $request->user;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user
        ], Response::HTTP_CREATED)->withCookie('cookie_token', $token, 60 * 24);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();

            $token = $user->createToken('authToken')->plainTextToken;

            $cookie = cookie('cookie_token', $token, 60 * 24);
            return response(["token" => $token, "user" => $user], Response::HTTP_OK)->withCookie($cookie);
        } else {
            return response(["message" => "Invalid credentials"], Response::HTTP_UNAUTHORIZED);
        }
    }


    public function userProfile()
    {
        return response()->json([
            "userData" => auth()->user()
        ], Response::HTTP_OK);
    }


    public function logout(Request $request)
    {
        $cookie = cookie('cookie_token', null, -1);
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => "Logged out"
        ], Response::HTTP_OK)->withCookie($cookie);
    }
}
