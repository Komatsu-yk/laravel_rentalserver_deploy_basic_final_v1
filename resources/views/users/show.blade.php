@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    @if(is_null($user))
        <p>該当ユーザーがいません</p>
    @else
        @if(Auth::user()->id === $user->id)
            [<a href="{{ route('users.edit') }}">編集</a>]
        @endif
        <dl>
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
            <dt>{{ $user->name }}の投稿一覧</dt>
            <dd>
                <ul class="posts">
                    @forelse($posts as $post)
                        <li class="post">
                            <div class="post_content">
                                <div class="post_body">
                                    <div class="post_body_heading">
                                        投稿者:{{ $post->user->name }}
                                        ({{ $post->created_at }})
                                    </div>
                                    <div class="post_body_main">
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
                {{ $posts->links() }}
            </dd>
        </dl>
    @endif
@endsection