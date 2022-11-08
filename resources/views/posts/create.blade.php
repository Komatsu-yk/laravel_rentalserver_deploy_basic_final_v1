@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" >
        @csrf
        <div>
            <label>
                コメント:
                <textarea name="comment" rows="5" cols="30" class="textarea"></textarea>
            </label>
        </div>
        <div>
            <label>
                画像:
                <input type="file" name="image">
            </label>
        </div>
        <input type="submit" value="投稿">
    </form>
@endsection
