<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function showMain()
    {
        return view('pages.main');
    }

    public function showProfile()
    {

        return view('pages.profile');
    }

    public function showLogin()
    {

        return view('pages.login');
    }



}

