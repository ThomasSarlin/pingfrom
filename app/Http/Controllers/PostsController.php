<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Cookie;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Cookie::get('userName')==null){
            return redirect('/')->with('error','Set nickname to proceed');
        }
        $data = array(
            'title'=>'Welcome to the Chat',
            'text' => 'Here you can represent your country in a fierce discussion',
            'buttonText' =>'Send reply',
            'fieldText' =>'Apply creative message:'
        );
        $posts = Post::all();
        return view('posts.chat')->with('posts',$posts)->with($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'body'=>'required'
        ]);
        
        $post = new Post;
        $post->body = $request->input('body');
        $post->country= Cookie::get('country');
        $post->userName= Cookie::get('userName');
        $post->save();
        return redirect('/chat');
    }

}
