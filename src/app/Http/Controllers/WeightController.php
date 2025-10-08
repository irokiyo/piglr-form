<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeightController extends Controller
{
    //ログイン
    public function showLogin(){
        return view('login');
    }
    //新規登録１の画面表示
    public function registerStep1(){
        return view('register_step1');
    }
    //新規登録2の画面表示
    public function registerStep2(){
        return view('register_step2');
    }
    
}
