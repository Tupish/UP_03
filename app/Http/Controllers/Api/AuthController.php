<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($validate)) {
            return response()->json([
                "error" => "Учетная запись не найдена!"
            ], 404);
        }

        return response()->json([
            "user" => Auth::user(),
            "token" => Auth::user()->createToken("auth_api")->plainTextToken
        ]);
    }

    public function register()
    {

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "message" => "Вы успешно вышли"
        ]);
    }
}
