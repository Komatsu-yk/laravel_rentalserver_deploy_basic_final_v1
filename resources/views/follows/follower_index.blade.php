@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h4><span>{{ $title }}</span></h4>
    
    <ul class="followers fit container">
        @forelse($followers as $follower)
            <li class="follower">
                <a href="{{ route('users.show', $follower) }}">
                    @if($follower->image !== '')
                        <img src="{{ \Storage::url($follower->image) }}" class="user_icon">
                    @else
                        <img src="{{ asset('images/no_image.png') }}" class="user_icon">
                    @endif
                    {{ $follower->name }}
                </a>
                @if(Auth::user()->isFollowing($follower))
                    <form method="post" action="{{ route('follows.destroy', $follower)}}" class="follow">
                        @csrf
                        @method('delete')
                            <input type="submit" value="フォロー解除">
                    </form>
                @else
                    <form method="post" action="{{ route('follows.store') }}" class="follow">
                        @csrf
                            <input type="hidden" name="follow_id" value="{{ $follower->id }}">
                            <input type="submit" value="フォロー">
                    </form>
                @endif
            </li>
        @empty
            <li>フォローされているユーザーはいません。</li>
        @endforelse
    </ul>
@endsection