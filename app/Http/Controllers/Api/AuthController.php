<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Se encarga de registrar un usuario
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required|max:15|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = new User();
        $user->user = $request->user;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ], Response::HTTP_CREATED)->withCookie('cookie_token', $token, 60);
    }

    /**
     * Se encarga de loguear un usuario
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required', 'email',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                $user = User::where('email', $request->email)->first();

                $token = $user->createToken('authToken', ['*'], $request->remember_me ? Carbon::now()->addDays(7) : null)->plainTextToken;

                $cookie = cookie('cookie_token', $token, 60);
                return response(["token" => $token, "user" => $user], Response::HTTP_OK)->withCookie($cookie);
            } else {
                return response(["message" => "Invalid credentials"], Response::HTTP_UNAUTHORIZED);
            }
        } catch (\Throwable $th) {
            return response(["message" => $th->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Se encarga de cerrar la sesión de un usuario
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $cookie = cookie('cookie_token', null, -1);

        $request->user()->currentAccessToken()->delete();
        Cookie::forget('cookie_token');
        return response()->json([
            "message" => "Logged out"
        ], Response::HTTP_OK)->withCookie($cookie);
    }
}
