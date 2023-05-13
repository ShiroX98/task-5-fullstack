<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return response([
            'status' => true,
            'message' => 'Test'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('authToken')->accessToken;
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function register(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'token' => $token,
            'status' => true,
            'message' => 'Registrasi berhasil'
        ], 201);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil logout'
        ], 200);
    }
}
