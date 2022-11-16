@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    @if(\Auth::user()->id === $post->user_id)
        <h4><span>{{ $title }}</span></h4>
        
        <form method="POST" action="{{ route('posts.update', $post) }}" class="fit container">
            @csrf
            @method('patch')
            [<a href="{{ route('posts.index') }}">戻る</a>]
            <div>
                <label>
                    コメント:
                    <textarea name="comment" rows="5" cols="42" class="textarea">{{ $post->comment }}</textarea>
                </label>
            </div>
            <!--<div>-->
            <!--    <label>-->
            <!--        url:-->
                    <input type="hidden" name="url" id="url">
            <!--    </label>-->
            <!--</div>-->
            <input type="submit" value="投稿">
        </form>
        <script>
            window.onload = function () {
                let url = document.referrer;
                
                document.getElementById( "url" ).value = url ;
            }
        </script>
    @else
        編集できません
    @endif
    <!--<p class="test">-->
    <!--    １２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０-->
    <!--</p>-->
@endsection