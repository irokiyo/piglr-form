<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('/logout', [WeightController::class, 'logout'])->name('logout'); //ログアウト

Route::get('/register/step1', [WeightController::class, 'registerStep1'])->name('register.step1'); //会員登録の画面表示
Route::post('/register/step1', [WeightController::class, 'storeStep1'])->name('register.step1.store'); //会員の情報登録
Route::get('/register/step2', [WeightController::class, 'registerStep2'])->name('register.step2'); //初期目標体重登録画面の表示
Route::post('/register/step2', [WeightController::class, 'storeStep2'])->name('register.step2.store'); //初期目標体重登録

Route::get('/weight_logs', [WeightController::class, 'index'])->middleware('auth')->name('index'); //トップページ(管理画面)
Route::post('/weight_logs/create', [WeightController::class, 'store'])->name('store'); //体重登録
Route::get('/weight_logs/search', [WeightController::class, 'search'])->name('search'); //体重検索
Route::get('/weight_logs/{:weightLogId}', [WeightController::class, 'show'])->name('show'); //体重詳細
Route::patch('/weight_logs/{:weightLogId}/update', [WeightController::class, 'update'])->name('update'); //体重更新
Route::delete('/weight_logs/{:weightLogId}/delete', [WeightController::class, 'delete'])->name('delete'); //体重削除


