@extends('layouts.logged_in')

@section('content')
    <h1>{{ $title }}</h1>
    
    <ul class="follow_users">
        @forelse($follow_users as $follow_user)
            <li class="follow_user">
                <a href="{{ route('users.show', $follow_user) }}">{{ $follow_user->name }}</a>
                <form method="post" action="{{ route('follows.destroy', $follow_user) }}" class="follow">
                    @csrf
                    @method('delete')
                    <input type="submit" value="フォロー解除">
                </form>
            </li>
        @empty
            <li>フォローしているユーザーはいません。</li>
        @endforelse
    </ul>
@endsection