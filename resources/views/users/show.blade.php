@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h4><span>{{ $title }}</span></h4>
    
    @if(is_null($user))
        <p class="fit container">該当ユーザーがいません</p>
    @else
        <dl>
            <div class="fit container">
                <dt>名前</dt>
                    <dd>
                        {{ $user->name }}
                        @if(Auth::user()->id !== $user->id)
                            @if( Auth::user()->isFollowing( $user ))
                                <form method="post" action="{{route( 'follows.destroy', $user )}}" class="follow">
                                    @csrf
                                    @method('delete')
                                        <input type="submit" value="フォロー解除">
                                </form>
                            @else
                                <form method="post" action="{{ route('follows.store') }}" class="follow">
                                    @csrf
                                        <input type="hidden" name="follow_id" value="{{ $user->id }}">
                                        <input type="submit" value="フォロー">
                                </form>
                            @endif
                        @endif
                    </dd>
                <dt>プロフィール画像</dt>
                    <dd>
                        @if($user->image !== '')
                            <img src="{{ \Storage::url($user->image) }}" class=profile_img>
                        @else
                            <img src="{{ secure_asset('images/no_image.png') }}" class="profile_img">
                        @endif
                    </dd>
                <dt>プロフィール</dt>
                    <dd>
                        @if($user->profile !== '')
                            {!! nl2br(e($user->profile)) !!}
                        @else
                            プロフィールが設定されていません。
                        @endif
                    </dd>
                <div class="text container">
                    @if(Auth::user()->id === $user->id)
                        [<a href="{{ route('users.edit') }}">編集</a>]
                        [<a href="{{ route('users.edit_image', $user) }}">画像を変更</a>]
                    @endif
                </div>
            </div>
            
            <h4><dt><span>{{ $user->name }}の投稿一覧</span></dt></h4>
            <div class="fit container">
                <dd>
                    <ul class="posts container">
                        @forelse($posts as $post)
                            <li class="user_post container">
                                <div class="post_content">
                                    <div class="post_body">
                                        <div class="post_body_heading">
                                            投稿者:{{ $post->user->name }}
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
                                        @if(Auth::user()->id === $post->user->id)
                                            <div class="post_body_footer text container">
                                                [<a href="{{ route('posts.edit', $post) }}">編集</a>]
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
                    {{ $posts->links() }}
                </dd>
            </div>
        </dl>
    @endif
@endsection