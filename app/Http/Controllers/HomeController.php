<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function showMain(){
        return view('pages.main');
    }

    public function showProfile(){
        if (!auth()->check()) {
            return redirect('/login');
        }
        return view('pages.profile', ['user' => auth()->user()]);


    }

    public function showLogin(){
        return view('pages.login');
    }

    public function showRegister(){
        return view('pages.register');
    }

}

