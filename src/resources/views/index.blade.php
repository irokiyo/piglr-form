{{-- resources/views/index.blade.php --}}
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
                <span class="num">50</span>
                <span class="unit">kg</span>
            </p>
        </article>

        <article class="stat-card">
            <p class="stat-label">目標まで</p>
            <p class="stat-value">
                <span class="num">50</span>
                <span class="unit">kg</span>
            </p>
        </article>

        <article class="stat-card">
            <p class="stat-label">最新体重</p>
            <p class="stat-value">
                <span class="num">50</span>
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
            </form>

            {{-- 追加はモーダルや別画面でもOK。ここでは別画面GET想定 
            <a href="{{ route('weight_logs.create.form') }}" class="btn btn-accent">データ追加</a>
        </div>

        {{-- 一覧テーブル 
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>体重</th>
                        <th>食事摂取カロリー</th>
                        <th>運動時間</th>
                        <th class="col-actions">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                    <tr>
                        <td>{{ \Illuminate\Support\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                        <td>{{ number_format($log->weight, 1) }}kg</td>
                        <td>{{ number_format($log->calories) }}cal</td>
                        <td>{{ str_pad(intval($log->exercise_time / 60), 2, '0', STR_PAD_LEFT) }}:{{ str_pad($log->exercise_time % 60, 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="col-actions">
                            <a href="{{ route('show', ['weightLogId' => $log->id]) }}" class="icon-btn" aria-label="編集">
                                ✏️
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty">データがありません</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ページネーション 
        @if (method_exists($logs, 'links'))
        <div class="pagination">
            {{ $logs->onEachSide(1)->links('vendor.pagination.simple-default') }}
        </div>
        @endif--}}

    </section>
</div>
@endif
@endsection


