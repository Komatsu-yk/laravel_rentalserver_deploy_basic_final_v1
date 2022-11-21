@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h4><span>{{ $title }}</span></h4>
    
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="fit container">
        @csrf
        [<a href="{{ route('posts.index') }}">戻る</a>]
        <div>
            <label>
                コメント:
                <textarea name="comment" rows="5" cols="42" class="textarea"></textarea>
            </label>
        </div>
        <div>
            <label>
                画像:
                <input type="file" name="image">
            </label>
        </div>
        <input type="submit" value="投稿">
        <!--<p class="test ">-->
        <!--１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０-->
        <!--</p>-->
    </form>
    
@endsection
