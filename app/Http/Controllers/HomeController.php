<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
