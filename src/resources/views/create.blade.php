@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}" />
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
@endsection

@section('content')
@if (Auth::check())

<section class="stats">
    <h2 id="wl-modal-title" class="modal__title">Weight Logを追加</h2>

    <form class="form" method="POST" action="{{ route('store') }}">
        @csrf
        {{-- 日付 --}}
        <div class="form__group">
            <label for="date">日付<span class="required">必須</span></label>
            <input id="date" name="date" type="date" value="{{ old('date') }}">
            @error('date') <p class="form__error">{{ $message }}</p> @enderror
        </div>

        {{-- 体重 --}}
        <div class="form__group">
            <label for="weight">体重 (kg)<span class="required">必須</span></label>
            <input id="weight" name="weight" type="number" step="0.1" min="0" value="{{ old('weight') }}" placeholder="50.0">kg

            @error('weight') <p class="form__error">{{ $message }}</p> @enderror
        </div>

        {{-- 摂取カロリー --}}
        <div class="form__group">
            <label for="calories">摂取カロリー (cal)<span class="required">必須</span></label>
            <input id="calories" name="calories" type="number" min="0" value="{{ old('calories') }}" placeholder="1200">cal
            @error('calories') <p class="form__error">{{ $message }}</p> @enderror
        </div>

        {{-- 運動時間 --}}
        <div class="form__group">
            <label for="exercise_time">運動時間<span class="required">必須</span></label>
            <input id="exercise_time" name="exercise_time" type="time" value="{{ old('exercise_time','00:00') }}" required>
            @error('exercise_time') <p class="form__error">{{ $message }}</p> @enderror
        </div>

        {{-- 運動内容 --}}
        <div class="form__group">
            <label for="exercise_note">運動内容</label>
            <textarea id="exercise_note" name="exercise_note" rows="4" placeholder="運動内容を追加">{{ old('exercise_note') }}</textarea>

            @error('exercise_note') <p class="form__error">{{ $message }}</p> @enderror
        </div>

        <div class="form__actions">
            <div class="form__actions-two"></div>
            <a href="#" class="btn btn--ghost">戻る</a>
            <button type="submit" class="btn btn--primary">登録</button>
        </div>
        <div class="form__actions-two">
            <button type="submit" class="btn btn--delete">🗑️</button>
        </div>
        </div>
    </form>
</section>
@endif
@endsection


