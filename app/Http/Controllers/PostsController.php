<?php

namespace App\Http\Controllers;


use App\Models\Posts;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //


    public function viewSinglePost(Posts $post){
        $post['body']=strip_tags(Str::markdown($post->body),'<p><strong><em><li><ul><lo><h3>');
        return view('single-post',['post'=>$post]);
    }
    
    public function showPostForm(){
        return view('create-post');
    }
    
    public function registerPost(Request $request){
        $incomingFields=$request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        
        $incomingFields['title']=strip_tags($incomingFields['title']);
        $incomingFields['body']=strip_tags($incomingFields['body']);
        $incomingFields['user_id']=auth()->id();
        
       $newpost= Posts::create($incomingFields);
        return redirect("/post/{$newpost->id}")->with('success','New post successfully created');
    }

}
