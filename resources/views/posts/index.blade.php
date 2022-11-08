@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <div>
        <form action="{{ route('posts.index') }}" method="GET" class="search">
            @csrf
            <input type="text" name="keyword" value="{{ $keyword }}">
            <input type="submit" value="検索">
        </form>
    </div>
    <h2>おすすめユーザー</h2>
    <ul class="recommended_users">
        @forelse($recommended_users as $recommend_user)
            <li>
                <a href="{{ route('users.show', $recommend_user) }}">
                    @if($recommend_user->image !== '')
                        <img src="{{ \Storage::url($recommend_user->image) }}" class="user_icon">
                    @else
                        <img src="{{ asset('images/no_image.png') }}" class="user_icon">
                    @endif
                    {{ $recommend_user->name }}
                </a>
            </li>
        @empty
            <li>おすすめユーザーはいません。</li>
        @endforelse
    </ul>
    <h1>{{ $title }}</h1>
    <ul class="posts">
        @forelse($posts as $post)
            <li class="post">
                <div class="post_content">
                    <div class="post_body">
                        <div class="post_body_heading">
                            投稿者:
                            <a href="{{ route('users.show', $post->user) }}">
                                @if($post->user->image !== '')
                                    <img src="{{ \Storage::url($post->user->image) }}" class="user_icon">
                                @else
                                    <img src="{{ asset('images/no_image.png') }}" class="user_icon">
                                @endif
                                {{ $post->user->name }}
                            </a>
                            ({{ $post->created_at }})
                        </div>
                        <div class="post_body_main">
                            <div class="post_body_main_img">
                                @if($post->image !== '')
                                    <img src="{{ \Storage::url($post->image) }}">
                                @else
                                    <img src="{{ asset('images/no_image.png') }}">
                                @endif
                                
                                @if(Auth::user()->id === $post->user->id)
                                    <a href="{{ route('posts.edit_image', $post) }}">画像を変更</a>
                                @endif
                            </div>
                            <div class="post_body_main_comment">
                                {!! nl2br(e($post->comment)) !!}
                            </div>
                        </div>
                        @if(Auth::user()->id === $post->user->id)
                            <div class="post_body_footer">
                                [<a href="{{ route('posts.edit', $post) }}">編集</a>]
                            <form method="post" class="delete" action="{{ route('posts.destroy', $post) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="削除">
                            </form>
                            </div>
                        @endif
                    </div>
                </div>
            </li>
        @empty
            <li>投稿がありません</li>
        @endforelse
    </ul>
    {{ $posts->appends(['keyword' => $keyword ?? '' ])->links() }}
@endsection