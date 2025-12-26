<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                "error" => "Неверный логин или пароль"
            ], 401);
        }

        $user = Auth::user();


        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => "Вы успешно вышли"
        ]);
    }

    public function profile(Request $request)
    {
        $user = $request->user();


        if ($user->role_id === 1) {

            $user->load([
                'student.group',
                'student.department',
                'student.marks' => function($query) {
                    $query->with([
                        'subject',
                        'teacher.user'
                    ])->orderBy('date', 'desc')->limit(50);
                }
            ]);
        } elseif ($user->role_id === 2) {

            $user->load([
                'teacher',
            ]);
        }

        return response()->json($user);
    }
}

