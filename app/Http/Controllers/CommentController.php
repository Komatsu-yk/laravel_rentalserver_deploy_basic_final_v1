<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request){
        Comment::create([
            'post_id'    => $request->post_id,
            'user_id'    => \Auth::user()->id,
            'body'       => $request->body,
            'position_x' => $request->position_x,
            'position_y' => $request->position_y
        ]);
        session()->flash('success', 'コメントを投稿しました');
        return redirect()->route('posts.show', $request->post_id);
    }
    
    public function destroy(Comment $comment)
    {
        $comment->delete();
        \Session::flash('success', '投稿を削除しました');
        return redirect()->route('posts.show', $comment->post_id);
    }
}
