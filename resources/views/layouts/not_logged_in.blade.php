@extends('layouts.default')

@section('header')
<header>
    <ul class="not_logged_in_header">
        <li>
            <a href="{{ route('register') }}">
                サインアップ
            </a>
        </li>
        <li>
            <a href="{{ route('login') }}">
                ログイン
            </a>
        </li>
    </ul>
</header>
@endsection