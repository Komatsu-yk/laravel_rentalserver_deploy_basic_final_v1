@extends('layouts.default')

@section('header')
<header>
    <div class="body container">
        <div class="top">
            <div>
                <a href="{{ route('posts.index') }}"><img src="{{ secure_asset('images/komatsu_logo.png') }}" alt="サイトロゴ" class="logo"></a>
            </div>
            <div class="right fit">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input type="submit" value="ログアウト">
                </form>
            </div>
        </div>
    </div>
    <div class="header_label">
        <div class="flex body container">
            <ul class="flex">
                <li>
                    <a href="{{ route('posts.index') }}">
                        ホーム
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.show', Auth::user()) }}">
                        ユーザープロフィール
                    </a>
                </li>
                <li>
                    <a href="{{ route('follows.index') }}">
                        フォロー一覧
                    </a>
                </li>
                <li>
                    <a href="{{ route('follower.followerIndex') }}">
                        フォロワー一覧
                    </a>
                </li>
            </ul>
            <div class="right">
                <input type="button" onclick="location.href='{{ route('posts.create') }}'" value="新規投稿">
            </div>
        </div>
    </div>
</header>
@endsection
