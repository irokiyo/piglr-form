<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $weightLogs = WeightLog::where('user_id', $userId)->paginate(8);
        $weightTargets = WeightTarget::where('user_id', $userId)->paginate(8);;

        return view('index',compact('weightLogs','weightTargets'));
    }
    //管理画面の表示
    public function index(Request $request){
        $userId = auth()->id();
        //目標体重
        $weightTarget = WeightTarget::where('user_id', $userId)->first();
        //最新体重
        $latestWeight = WeightLog::where('user_id', $userId)->latest()->first();
        //一覧表示
        $weightLogs = WeightLog::where('user_id', $userId)->paginate(8);
        $hasSearch=$request->filled('from') || $request->filled('to');

        return view('index',compact('weightLogs','weightTarget','latestWeight','hasSearch'));
    }
    //検索
    public function search(Request $request){
        $userId = auth()->id();
        //検索
        $query= WeightLog::where('user_id', $userId)->orderByDesc('date');
        if ($request->filled('from')) {
            $query->whereDate('date','>=',$request->input('from'));
        }
        if ($request->filled('to')){
            $query->whereDate('date','<=',$request->input('to'));
        }
        $weightLogs =$query->paginate(8)->withQueryString();

        $hasSearch=$request->filled('from') || $request->filled('to');

        //目標体重
        $weightTarget = WeightTarget::where('user_id', $userId)->first();
        //最新体重
        $latestWeight = WeightLog::where('user_id', $userId)->latest()->first();
        return view('index',compact('weightLogs','weightTarget','latestWeight','hasSearch'));
    }
    //データ登録
    public function store(Request $request){
        $userId = auth()->id();

        

        return view('index');

    }
    //ログアウト
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();//セキュリティ関連
        
        return view('login');
    }
}
