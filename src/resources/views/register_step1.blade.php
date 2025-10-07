@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register_step1.css') }}" />
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
@endsection

@section('content')
<p class="auth-card__title">新規会員登録</p>
<p class="auth-card__subtitle">STEP1 アカウント情報の登録</p>

<form class="auth-form" method="post" action="{{ route('register.step1.store') }}">
    @csrf

    <div class="form-group">
        <label for="name" class="form-label">お名前</label>
        <input id="name" name="name" type="text" class="form-input" placeholder="名前を入力" value="{{ old('name') }}" required>
        @error('name') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="email" class="form-label">メールアドレス</label>
        <input id="email" name="email" type="email" class="form-input" placeholder="名前を入力" value="{{ old('email') }}" required>
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="password" class="form-label">パスワード</label>
        <input id="password" name="password" type="password" class="form-input" placeholder="名前を入力" required>
        @error('password') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="auth-button">次に進む</button>
</form>

<a class="auth-link" href="{{ route('login') }}">ログインはこちら</a>
</div>
</div>
@endsection

