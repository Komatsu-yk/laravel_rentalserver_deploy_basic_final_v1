@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h4><span>{{ $title }}</span></h4>

    <div class="post_show container">
        <div class="post_content">
            <div class="post_body">
                <div class="post_body_heading fit container">
                    <a href="{{ route('users.show', $post->user) }}">
                        投稿者:
                        @if($post->user->image !== '')
                            <img src="{{ \Storage::url($post->user->image) }}" class="user_icon">
                        @else
                            <img src="{{ secure_asset('images/no_image.png') }}" class="user_icon">
                        @endif
                        {{ $post->user->name }}
                    </a>
                    <div>
                        投稿日:({{ $post->created_at }})
                    </div>
                    <div class="post_show_body_main_comment">
                        {!! nl2br(e($post->comment)) !!}
                    </div>
                </div>
                @if(Auth::user()->id === $post->user->id)
                    <div class="post_body_footer text container">
                        [<a href="{{ route('posts.edit', $post) }}">投稿を編集</a>]
                        [<a href="{{ route('posts.edit_image', $post) }}">画像を変更</a>]
                    <form method="post" class="delete" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="削除">
                    </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <p class="post_show_text text container">↓クリックしてコメントを投稿↓</p>
    <div class="post_show_body">
        <div class="post_show_body_img container" data-toggle="modal" data-target="#modal1"  id="show_img">
            @if($post->image !== '')
                <img src="{{ \Storage::url($post->image) }}">
            @else
                <img src="{{ secure_asset('images/no_image.png') }}">
            @endif
                                        
            @if(Auth::user()->id === $post->user->id)
                                            
            @endif
        </div>
        @forelse($comments as $comment)
                <div class="comment_body_{{ $comment->id }}" id="comment_body">
                    <a href="{{ route('users.show', $comment->user) }}">
                        <div class="comment_user">
                            <p>投稿者:</p>
                            <p class="comment_name">{{ $comment->user->name }}</p>
                        </div>
                    </a>
                    <p class="comment">{!! nl2br(e($comment->body)) !!}</p>
                    @if(Auth::user()->id === $comment->user->id)
                        <form method="post" class="comment_delete_form" action="{{ route('comments.destroy', $comment) }}">
                            @csrf
                            @method('delete')
                            <div class="container fit">
                                <input type="submit" value="削除" class="comment_delete">
                            </div>
                        </form>
                    @endif
                    <style>
                        .comment_body_<?php echo $comment->id?>{
                            top: <?php echo $comment->position_y;?>px;
                            left: <?php echo $comment->position_x;?>px;
                        }
                    </style>
                </div>
        @empty
        @endforelse
    </div>
    <div class="modal fade" id="modal1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="{{ route('comments.store') }}">
                    @csrf
                    <!--<div>-->
                    <!--    <label>-->
                    <!--        <p>post_id:</p>-->
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <!--    </label>-->
                    <!--</div>-->
                    <div class="fit container">
                        <label>
                            <p>コメント:</p>
                            <textarea name="body" rows="5" class="modal_textarea" id="limited"></textarea>
                        </label>
                    </div>
                    <!--<div>-->
                    <!--    <label>-->
                    <!--        <p>position_x:</p>-->
                            <input type="hidden" name="position_x" id="position_x">
                    <!--    </label>-->
                    <!--</div>-->
                    <!--<div>-->
                    <!--    <label>-->
                    <!--        <p>position_y:</p>-->
                            <input type="hidden" name="position_y" id="position_y">
                    <!--    </label>-->
                    <!--</div>-->
                    <div class="container fit">
                        <input type="submit" value="送信">
                    </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>
    <script>
        const getPosition = () => {
            document.getElementById( "show_img" ).addEventListener( "click", function(event){
                    var click_x = event.pageX ;
                	var click_y = event.pageY ;
                
                	// 要素の位置を取得
                	var client_rect = this.getBoundingClientRect() ;
                	var position_x = client_rect.left + window.pageXOffset ;
                	var position_y = client_rect.top + window.pageYOffset ;
                
                	// 要素内におけるクリック位置を計算
                	var x = Math.round(click_x - position_x) ;
                	if(x > 884){
                	    x = 884;
                	}
                	
                	var y = Math.round(click_y - position_y) ;
                	if(y > 874){
                	    y = 874;
                	}
                	
                	document.getElementById( "position_x" ).value = x ;
                	document.getElementById( "position_y" ).value = y ;
                });
        }
            
        getPosition();
        
        const limitText = () => {
            // 入力できる行数の最大値
            let MAX_LINE_NUM = 7;
     
            // テキストエリアの取得
            let textarea = document.getElementById("limited");
     
            // 入力ごとに呼び出されるイベントを設定
            textarea.addEventListener("input", function() {
     
                // 各行を配列の要素に分ける
                let lines = textarea.value.split("\n");
         
                // 入力行数が制限を超えた場合
                if (lines.length > MAX_LINE_NUM) {
         
                    var result = "";
         
                    for (var i = 0; i < MAX_LINE_NUM; i++) {
                        result += lines[i] + "\n";
                    }
                    
                    textarea.value = result;
                }
            }, false);
        }
        
        limitText();
  </script>
@endsection