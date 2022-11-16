@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h4><span>{{ $title }}</span></h4>
    
    <h4><span>現在の画像</span></h4>
    <div class="container fit">
        <p>[<a href="{{ route('users.show', $user) }}">戻る</a>]</p>
        @if($user->image !== '')
            <img src="{{ \Storage::url($user->image) }}" class="profile_img">
        @else
            画像はありません。
        @endif
        <form
            method="POST"
            action="{{ route('users.update_image') }}"
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
                <input type="submit" value="更新">
        </form>
    </div>
@endsection