@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <form method="POST" action="{{ route('users.update') }}">
        @csrf
        @method('patch')
        <dl>
            <dt>名前</dt>
            <dd>
                <label>
                    <input type="text" name="name" value=" {{ $user->name }} ">
                </label>
            </dd>
        </dl>
        <input type="submit" value="更新">
    </form>
@endsection