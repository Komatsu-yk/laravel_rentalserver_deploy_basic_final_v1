@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h4><span>{{ $title }}</span></h4>
    
    <h4><span>現在の画像</span></h4>
    <div class="fit container">
        <p>[<a href="{{ route('posts.index') }}">戻る</a>]</p>
        @if($post->image !== '')
            <img src="{{ \Storage::url($post->image) }}">
        @else
            画像はありません。
        @endif
        <form
            method="POST"
            action="{{ route('posts.update_image', $post) }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('patch')
            <div>
                <label>
                    画像を選択:
                    <input type="file" name="image">
                </label>
            </div>
            <!--<div>-->
            <!--    <label>-->
            <!--        url:-->
                    <input type="hidden" name="url" id="url">
            <!--    </label>-->
            <!--</div>-->
            <input type="submit" value="更新">
        </form>
    </div>
    <script>
            window.onload = function () {
                let url = document.referrer;
                
                document.getElementById( "url" ).value = url ;
            }
    </script>
@endsection