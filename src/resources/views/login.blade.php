@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
@endsection

@section('content')

<p class="auth-card__title">ログイン</p>

<form class="auth-form" method="post" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
        <label for="email" class="form-label">メールアドレス</label>
        <input id="email" name="email" type="email" class="form-input" placeholder="名前を入力" value="{{ old('email') }}" required autofocus>
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="password" class="form-label">パスワード</label>
        <input id="password" name="password" type="password" class="form-input" placeholder="名前を入力" required>
        @error('password') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="auth-button">ログイン</button>
</form>

<a class="auth-link" href="{{--{{ route('register') }}--}}">アカウント作成はこちら</a>

@endsection

