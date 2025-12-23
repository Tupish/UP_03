<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function showMain(){
        return view('pages.main');
    }
    public function showLogin(){
        return view('pages.login');
    }
    public function showRegister(){
        return view('pages.register');
    }


    public function showProfile(){
        if (!auth()->check()) {
            return redirect('/login');
        }
        return view('pages.profile');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'grade_book'=> $request->grade,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id'=>$request->role,
        ]);
        auth()->login($user);

        return redirect('/profile');
    }
    public function login(Request $request)
    {
        if (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])) {
            $request->session()->regenerate();
            return redirect('/profile');
        }
    }
}

