<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = $request->user();


        if (!$user) {
            return response()->json([
                "message" => "Пользователь не авторизован!"
            ], 401);
        }

        if (!$user->hasRole($role)) {
            return response()->json([
                "message" => "Доступ запрещен!"
            ], 403);
        }

        return $next($request);
    }
}
