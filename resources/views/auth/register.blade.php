@extends('layouts.not_logged_in')

@section('content')
    <h4><span>サインアップ</span></h4>
    
    <form method="POST" action="{{ route('register') }}" class="edit fit container">
        @csrf
        <div>
            <label>
                <P>ユーザー名:</P>
                <input type="text" name="name" class="input">
            </label>
        </div>
        
        <div>
            <label>
                <p>メールアドレス:</p>
                <input type="email" name="email" class="input">
            </label>
        </div>
        
        <div>
            <label>
                <p>パスワード:</p>
                <input type="password" name="password" class="input">
            </label>
        </div>
        
        <div>
            <label>
                <p>パスワード（確認用）:</p>
                <input type="password" name="password_confirmation" class="input">
            </label>
        </div>
        
        <div>
            <input type="submit" value="登録" class="input_button">
        </div>
    </form>
@endsection
