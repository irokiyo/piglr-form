<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightController extends Controller
{

    //新規登録１の画面表示
    public function registerStep1(){
        return view('register_step1');
    }
    //新規登録2の画面表示
    public function registerStep2(){
        return view('register_step2');
    }
    public function index(){
        $weights = WeightLog::all();
        $weights = WeightTarget::all();
        return view('index');
    }
}
