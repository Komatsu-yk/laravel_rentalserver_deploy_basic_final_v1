@extends('layouts.default')

@section('header')
<header>
    <ul class="header_nav">
        <div class="header_left">
            <li>
                <a href="{{ route('posts.index') }}">
                    仮ロゴ
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
        </div>
        <li class="header_right">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
            <input type="button" onclick="location.href='{{ route('posts.create') }}'" value="新規投稿">
        </li>
    </ul>
</header>
@endsection
