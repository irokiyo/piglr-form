<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function showLogin(){
        return view('login');
    }
    public function registerStep1(){
        return view('register_step1');
    }
}
