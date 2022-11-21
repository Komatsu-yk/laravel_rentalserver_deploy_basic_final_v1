@extends('layouts.default')

@section('header')
<header>
    <div class="body container">
        <img src="{{ asset('images/komatsu_logo.png') }}" alt="サイトロゴ" class="logo">
    </div>
    <div class="header_label">
        <div class="flex body container">
            <ul class="flex">
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
        </div>
    </div>
</header>
@endsection
