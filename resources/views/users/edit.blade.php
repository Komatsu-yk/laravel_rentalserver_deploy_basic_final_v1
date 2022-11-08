@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <form method="POST" action="{{ route('users.update') }}">
        @csrf
        @method('patch')
        [<a href="{{ route('users.show', $user) }}">戻る</a>]
        <dl>
            <dt>名前:</dt>
            <dd>
                <label>
                    <input type="text" name="name" value="{{ $user->name }}" class="name">
                </label>
            </dd>
            <dt>メールアドレス:</dt>
            <dd>
                <label>
                    <input type="email" name="email" value="{{ $user->email }}">
                </label>
            </dd>
            <dt>プロフィール:</dt>
            <dd>
                <label>
                    <textarea name="profile" rows="5" cols="30" class="textarea">{{ $user->profile }}</textarea>
                </label>
            </dd>
        </dl>
        <input type="submit" value="更新">
    </form>
@endsection