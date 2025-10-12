@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
@if (Auth::check())
<div class="wl-edit">
    <div class="wl-edit__card">

        <h1 class="wl-edit__title">Weight Log</h1>

        {{-- 更新フォーム --}}
        <form class="wl-form" method="POST" action="{{ route('update',$weightLog->id) }}">

            @csrf
            @method('PATCH')

            {{-- 日付 --}}
            <div class="wl-form__group">
                <label for="date" class="wl-form__label">日付</label>
                <input id="date" name="date" type="date" class="wl-form__control" value="{{ old('date', $weightLog->date) }}" required>
                @error('date') <p class="wl-form__error">{{ $message }}</p> @enderror
            </div>

            {{-- 体重 --}}
            <div class="wl-form__group wl-form__group--with-unit">
                <label for="weight" class="wl-form__label">体重</label>
                <div class="wl-form__controlWrap">
                    <input id="weight" name="weight" type="number" step="0.1" min="0" class="wl-form__control" placeholder="50.0" value="{{ old('weight', $weightLog->weight) }}" required>
                    <span class="wl-form__unit">kg</span>
                </div>
                @error('weight') <p class="wl-form__error">{{ $message }}</p> @enderror
            </div>

            {{-- 摂取カロリー --}}
            <div class="wl-form__group wl-form__group--with-unit">
                <label for="calories" class="wl-form__label">摂取カロリー</label>
                <div class="wl-form__controlWrap">
                    <input id="calories" name="calories" type="number" min="0" step="1" class="wl-form__control" placeholder="1200" value="{{ old('calories', $weightLog->calories) }}" required>
                    <span class="wl-form__unit">cal</span>
                </div>
                @error('calories') <p class="wl-form__error">{{ $message }}</p> @enderror
            </div>

            {{-- 運動時間 --}}
            <div class="wl-form__group">
                <label for="exercise_time" class="wl-form__label">運動時間</label>
                <input id="exercise_time" name="exercise_time" type="time" class="wl-form__control" value="{{ old('exercise_time', $weightLog->exercise_time ?? '00:00') }}" required>
                @error('exercise_time') <p class="wl-form__error">{{ $message }}</p> @enderror
            </div>

            {{-- 運動内容 --}}
            <div class="wl-form__group">
                <label for="exercise_note" class="wl-form__label">運動内容</label>
                <textarea id="exercise_note" name="exercise_note" rows="5" class="wl-form__control wl-form__control--textarea" placeholder="運動内容を追加">{{ old('exercise_note', $weightLog->exercise_note) }}</textarea>
                @error('exercise_note') <p class="wl-form__error">{{ $message }}</p> @enderror
            </div>

            {{-- アクション行 --}}
            <div class="wl-edit__actions">
                <a href="{{ route('index') }}" class="btn btn--ghost">戻る</a>

                <button type="submit" class="btn btn--primary">更新</button>

                {{-- 削除 --}}
                <form method="POST" action="{{ route('delete',$weightLog->id) }}" class="wl-edit__delete">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="icon-btn" title="削除" onclick="return">
                        🗑️
                    </button>
                </form>
            </div>
        </form>

    </div>
</div>
@endif
@endsection

