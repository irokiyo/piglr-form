@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
@endsection

@section('content')

<h2 class="auth-card__title">新規登録</h2>
<p class="auth-card__subtitle">STEP2 体重データの入力</p>

<form class="auth-form" method="post" action="{{ route('register.step2.store') }}">
    @csrf

    <div class="form-group">
        <label for="" class="form-label">現在の体重</label>
        <input id="weight" name="weight" type="text" class="form-input" placeholder="現在の体重を入力" value="{{ old('weight') }}" >kg
        @error('weight') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="" class="form-label">目標の体重</label>
        <input id="target_weight" name="target_weight" type="text" class="form-input" placeholder="目標体重を入力" value="{{ old('target_weight') }}">kg
        @error('target-weight') <p class="form-error">{{ $message }}</p> @enderror
    </div>
    <button type="submit" class="auth-button">アカウント作成</button>
</form>
@endsection

