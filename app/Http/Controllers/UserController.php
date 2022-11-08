<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;
use App\Services\FileUploadService;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            $posts = [];
        }else{
            $posts = $user->posts()->latest()->paginate(10);
        }
        
        return view('users.show', [
            'title' => 'ユーザー詳細',
            'user'  => $user,
            'posts' => $posts,
        ]);   
    }

    public function edit()
    {
        $user = \Auth::user();
        return view('users.edit', [
            'title' => 'ユーザー編集',
            'user'  => $user
        ]);
    }

    public function update(UserRequest $request)
    {
        $user = \Auth::user();
        $profile = $request->profile;
        if($profile === null){
            $profile = '';
        }
        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'profile' => $profile,]);
        session()->flash('success', 'プロフィールを編集しました');
        return redirect()->route('users.show', $user);
    }
    
    public function editImage()
    {
        $user = \Auth::user();
        return view('users.edit_image', [
            'title' => '画像変更画面',
            'user'  => $user
        ]);
    }
    
    public function updateImage(UserImageRequest $request, FileUploadService $service)
    {
        $user  = \Auth::user();
        $path  = $service->saveImage($request->file('image'));
        
        if($user->image !== ''){
            \Storage::disk('public')->delete(\Storage::url($user->image));
        }
        
        $user->update([
            'image' => $path,
        ]);
        
        session()->flash('success', '画像を変更しました');
        return redirect()->route('users.show', $user);
    }
    
    private function saveImage($image){
        $path = '';
        if( isset($image) === true ){
            $path = $image->store('photos', 'public');
        }
        return $path;
    }
}
