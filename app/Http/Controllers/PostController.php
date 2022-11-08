<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostImageRequest;
use App\Services\FileUploadService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user              = \Auth::user();
        $follow_user_ids   = $user->follow_users->pluck('id');
        $user_posts        = $user->posts()->orWhereIn('user_id', $follow_user_ids)->latest()->paginate(10);
        $recommended_users = User::whereNotIn('id', $follow_user_ids)->recommend($user->id)->get();
        $keyword           = $request->input('keyword');
        $keyword           = preg_replace('/　|\s+/', '', $keyword);
        
        if($recommended_users->count() > 3){
            $recommended_users = $recommended_users->random(3);
        }
        
        if(mb_strlen($keyword)) {
            $user_posts = Post::where('comment', 'LIKE', "%{$keyword}%")->latest()->paginate(10);
        }
        
        return view('posts.index', [
            'title'             => '投稿一覧',
            'posts'             => $user_posts,
            'recommended_users' => $recommended_users,
            'keyword'           => $keyword
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
            'title' => '新規投稿',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, FileUploadService $service)
    {
        //画像追加
        $path = $service->saveImage($request->file('image'));
        
        Post::create([
            'user_id' => \Auth::user()->id,
            'comment' => $request->comment,
            'image'   => $path,
        ]);
        session()->flash('success', '投稿を追加しました');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', [
            'title' => '投稿詳細',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'title' => '投稿編集',
            'post'  => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->only(['comment']));
        session()->flash('success', '投稿を編集しました');
        return redirect()->route('posts.index');
    }
    
    public function editImage(Post $post)
    {
        return view('posts.edit_image', [
            'title' => '画像変更画面',
            'post'  => $post
        ]);
    }
    
    public function updateImage(Post $post, PostImageRequest $request, FileUploadService $service)
    {
        $path  = $service->saveImage($request->file('image'));
        
        if($post->image !== ''){
            \Storage::disk('public')->delete('photos/' . $post->image);
        }
        
        $post->update([
            'image' => $path,
        ]);
        
        session()->flash('success', '画像を変更しました');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image !== ''){
            \Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        \Session::flash('success', '投稿を削除しました');
        return redirect()->route('posts.index');
    }
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
}

