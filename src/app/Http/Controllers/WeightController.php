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
    //新規登録2
    public function storeStep2(Request $request){
        $targetWeight = $request->only(['target_weight']);
        $logWeight = $request->only(['weight']);
        $targetWeight['user_id'] = auth()->id();
        $logWeight['user_id'] = auth()->id();
        $logWeight['date'] =now()->toDateString();

        WeightTarget::create($targetWeight);
        WeightLog::create($logWeight);

        $userId = auth()->id();
        $weightLogs = WeightLog::where('user_id', $userId)->get();
        $weightTargets = WeightTarget::where('user_id', $userId)->get();

        return view('index',compact('weightLogs','weightTargets'));
    }
    //管理画面の表示
    public function index(){
        $userId = auth()->id();
        $weightLogs = WeightLog::where('user_id', $userId)->get();
        $weightTargets = WeightTarget::where('user_id', $userId)->get();

        return view('index',compact('weightLogs','weightTargets'));
    }
}
