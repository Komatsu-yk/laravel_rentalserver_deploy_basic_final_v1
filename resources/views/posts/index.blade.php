@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
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
                        <div class="post_body_footer">
                            [<a href="{{ route('posts.edit', $post) }}">編集</a>]
                        <form method="post" class="delete" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="削除">
                        </form>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li>投稿がありません</li>
        @endforelse
    </ul>
@endsection