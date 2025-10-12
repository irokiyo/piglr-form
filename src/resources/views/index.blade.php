@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
@endsection

@section('content')
@if (Auth::check())
<div class="admin-shell">

    {{-- 上段カード：目標/差分/最新 --}}
    <section class="stats">
        <article class="stat-card">
            <p class="stat-label">目標体重</p>
            <p class="stat-value">
                <span class="num">{{ $weightTarget->target_weight}}</span>
                <span class="unit">kg</span>
            </p>
        </article>

        <article class="stat-card">
            <p class="stat-label">目標まで</p>
            <p class="stat-value">
                <span class="num">{{ $latestWeight->weight- $weightTarget->target_weight}}</span>
                <span class="unit">kg</span>
            </p>
        </article>

        <article class="stat-card">
            <p class="stat-label">最新体重</p>
            <p class="stat-value">
                <span class="num">{{ $latestWeight->weight}}</span>
                <span class="unit">kg</span>
            </p>
        </article>
    </section>

    {{-- 検索＋追加 --}}
    <section class="panel">
        <div class="panel-toolbar">
            <form method="GET" action="{{ route('search') }}" class="search-form">
                @csrf

                <div class="field">
                    <input type="date" name="from" value="{{ request('from') }}" class="input input-date" placeholder="年/月/日">
                </div>
                <span class="range-sep">〜</span>
                <div class="field">
                    <input type="date" name="to" value="{{ request('to') }}" class="input input-date" placeholder="年/月/日">
                </div>
                <button type="submit" class="btn btn-dark">検索</button>
                @if($hasSearch)
                <a href="{{ route('index') }}" class="btn-reset">リセット</a>
                @endif
            </form>
            <a href="#createLog" class="btn btn-accent">データ追加</a>
        </div>
        @if($hasSearch)
        <p class="search-text">{{ request('from')??'指定無し' }}~{{ request('to')??'指定無し' }}の検索結果 {{ $weightLogs->total() }} 件</p>
        @endif

        {{--一覧テーブル--}}
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>体重</th>
                        <th>食事摂取カロリー</th>
                        <th>運動時間</th>
                        <th class="col-actions"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($weightLogs as $weightLog)
                    <tr>
                        <td class="table__data">{{ $weightLog->date }}</td>
                        <td class="table__data">{{ $weightLog->weight}}kg</td>
                        <td class="table__data">{{($weightLog->calories) }}cal</td>
                        <td class="table__data" {{$weightLog->exercise_time }}</td>
                        <td class="col-actions">
                            <a href="{{ route('show',$weightLog->id) }}" class="icon-btn" aria-label="詳細">
                                ✏️
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ページネーション--}}
        <div class="pagination">
            {{ $weightLogs->links('vendor.pagination.bootstrap-4') }}
        </div>
        {{-- ページ末尾（</main> の直前か、layoutの </body> 直前あたり） --}}
        <div id="createLog" class="modal" role="dialog" aria-modal="true" aria-labelledby="wl-modal-title">
            <div class="modal__content" role="document">
                <a href="#" class="modal__close" aria-label="閉じる">&times;</a>

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
                        <a href="#" class="btn btn--ghost">戻る</a> {{-- ← # に戻る＝モーダル閉じる --}}
                        <button type="submit" class="btn btn--primary">登録</button>
                    </div>
                </form>
        </div>
        </div>


    </section>
</div>
@endif
@endsection

