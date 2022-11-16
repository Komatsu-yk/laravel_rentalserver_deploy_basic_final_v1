@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h4><span>{{ $title }}</span></h4>
    <form method="POST" action="{{ route('users.update') }}" class="fit container">
        @csrf
        @method('patch')
            [<a href="{{ route('users.show', $user) }}">戻る</a>]
            <dl>
                <dt>名前:</dt>
                <dd>
                    <label>
                        <input type="text" name="name" value="{{ $user->name }}" class="edit_input">
                    </label>
                </dd>
                <dt>メールアドレス:</dt>
                <dd>
                    <label>
                        <input type="email" name="email" value="{{ $user->email }}" class="edit_input">
                    </label>
                </dd>
                <dt>プロフィール:</dt>
                <dd>
                    <label>
                        <textarea name="profile" rows="5" cols="42" class="textarea">{{ $user->profile }}</textarea>
                    </label>
                </dd>
            </dl>
        <input type="submit" value="更新">
        <!--<p class="test">-->
        <!--    １２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０-->
        <!--</p>-->
    </form>
@endsection