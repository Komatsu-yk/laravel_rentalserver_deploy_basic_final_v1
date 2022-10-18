@extends('layouts.default')

@section('header')
<header>
    <ul class="header_nav">
        <li class="header_left">
            <a href="{{ route('posts.index') }}">
                仮ロゴ
            </a>
        </li>
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
