@extends('layouts.not_logged_in')

@section('content')
    <h1>ログイン</h1>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>
                メールアドレス:
                <input type="email" name="email">
            </label>
        </div>
        
        <div>
            <label>
                パスワード:
                <input type="password" name="password">
            </label>
        </div>
        
        <input type="submit" value="ログイン">
    </form>
    
    <div>
        email: test@0000~test@4444<br>
        password: test0000~test4444
    </div>
@endsection