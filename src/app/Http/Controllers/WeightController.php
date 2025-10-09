<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Models\User;

class WeightController extends Controller
{

    //新規登録１の画面表示
    public function registerStep1(){
        return view('register_step1'); //viewファイル名
    }
    //新規会員登録
    public function storeStep1(Request $request){
        $user = $request->only(['name','email','password']);
        $user['password'] = bcrypt($user['password']);
        $user=User::create($user);
        auth()->login($user);

        return view('register_step2');

    }
    //新規登録2の画面表示
    public function registerStep2(){
        return view('register_step2');
    }
    //管理画面の表示
    public function index(){
        $weights = WeightLog::all();
        $weights = WeightTarget::all();
        return view('index');
    }
}
