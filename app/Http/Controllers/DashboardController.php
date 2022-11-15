<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){

        $default_password = Hash::check('password', Auth::user()->password);
        return Inertia::render('Dashboard',[
            'default_password'=> $default_password]
        );
    }

}
