@extends('layouts.not_logged_in')

@section('content')
    <h4><span>ログイン</span></h4>
    
    <form method="POST" action="{{ route('login') }}" class="edit fit container">
        @csrf
        <div>
            <label>
                <P>ユーザー名:</P>
                <input type="name" name="name" class="input">
            </label>
        </div>
        
        <div>
            <label>
                <p>パスワード:</p>
                <input type="password" name="password" class="input">
            </label>
        </div>
        
        <input type="submit" value="ログイン" class="input_button">
        
    </form>
@endsection