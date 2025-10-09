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

            {{-- 追加はモーダルや別画面でもOK。ここでは別画面GET想定--}}
            <a href="" class="btn btn-accent">データ追加</a>
        </div>

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
                        <td>{{ $weightLog->date }}</td>
                        <td>{{ $weightLog->weight}}kg</td>
                        <td>{{($weightLog->calories) }}cal</td>
                        <td>{{$weightLog->exercise_time }}</td>
                        <td class="col-actions">
                            <a href="" class="icon-btn" aria-label="詳細">
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
    </section>
</div>
@endif
@endsection


