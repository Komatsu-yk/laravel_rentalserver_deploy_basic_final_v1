@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <div>
        <form action="{{ route('posts.index') }}" method="GET" class="search">
            @csrf
            投稿検索:
            <input type="text" name="keyword" value="{{ $keyword }}">
            <input type="submit" value="検索">
        </form>
    </div>
    
    <h4><span>おすすめユーザー</span></h4>
    
    <ul class="recommended_users container">
        @forelse($recommended_users as $recommend_user)
            <li>
                <a href="{{ route('users.show', $recommend_user) }}">
                    @if($recommend_user->image !== '')
                        <img src="{{ \Storage::url($recommend_user->image) }}" class="user_icon">
                    @else
                        <img src="{{ secure_asset('images/no_image.png') }}" class="user_icon">
                    @endif
                    {{ $recommend_user->name }}
                </a>
            </li>
        @empty
            <li>他のユーザーが存在しません。</li>
        @endforelse
    </ul>
    
    <h4><span>{{ $title }}</span></h4>
    
    <ul class="posts container">
        @forelse($posts as $post)
            <li class="post container">
                <div class="post_content">
                    <div class="post_body">
                        <div class="post_body_heading">
                            <a href="{{ route('users.show', $post->user) }}">
                                投稿者:
                                @if($post->user->image !== '')
                                    <img src="{{ \Storage::url($post->user->image) }}" class="user_icon">
                                @else
                                    <img src="{{ secure_asset('images/no_image.png') }}" class="user_icon">
                                @endif
                                {{ $post->user->name }}
                            </a>
                            <div>
                                投稿日:({{ $post->created_at }})
                            </div>
                        </div>
                        <a href="{{ route('posts.show', $post)}}">
                            <div class="post_body_main">
                                <div class="post_body_main_img text container">
                                    @if($post->image !== '')
                                        <img src="{{ \Storage::url($post->image) }}">
                                    @else
                                        <img src="{{ secure_asset('images/no_image.png') }}">
                                    @endif
                                    
                                    @if(Auth::user()->id === $post->user->id)
                                        
                                    @endif
                                </div>
                                <div class="post_body_main_comment">
                                    {!! nl2br(e($post->comment)) !!}
                                </div>
                            </div>
                        </a>
                        <p class="text">↑クリックして詳細へ↑</p>
                        @if(Auth::user()->id === $post->user->id)
                            <div class="post_body_footer text container">
                                [<a href="{{ route('posts.edit', $post) }}">投稿を編集</a>]
                                [<a href="{{ route('posts.edit_image', $post) }}">画像を変更</a>]
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