<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Post;
use DB;
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
        $posts = DB::table('Tbl_Posts')
        ->join('Tbl_Countries','Co_Id','Tbl_Posts.Po_Co_Id')
        ->join('Tbl_Users','Us_Id','Tbl_Posts.Po_Us_Id')->select('Tbl_posts.*','Tbl_Users.*','Tbl_Countries.*')->get();
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
        
        DB::table('Tbl_Posts')->insert(
            [
                'Po_Body' => $request->input('body'),
                'Po_Co_Id' => DB::table('Tbl_Countries')->where('Co_Title',Cookie::get('country'))->value('Co_Id'),
                'Po_Us_Id' => DB::table('Tbl_users') -> where('Us_Name',Cookie::get('userName'))->value('Us_Id'),
                "created_at" =>  \Carbon\Carbon::now()->format('Y-m-d'),
                "updated_at" => \Carbon\Carbon::now()->format('Y-m-d')
            ]
        );
        return redirect('/chat');
    }
    public function edit(Request $request){
        switch($request->submitbutton){
            case 'Delete':
                DB::table('Tbl_Posts')->where('Po_Id',$request->input('post'))->delete();
                $message = 'Post deleted';
                break;
            case 'Save':
                $post = DB::table('Tbl_Posts')->where('Po_Id',$request->input('post'))
                ->update(['Po_Body' => $request->input('body')]);
                $message = 'Post updated';
                break;
        }
        return back()->with('success',$message);
    }

    public function filter(Request $request){

        $data = array(
            'title'=>'Welcome to the Chat',
            'text' => 'Here you can represent your country in a fierce discussion',
            'buttonText' =>'Send reply',
            'fieldText' =>'Apply creative message:'
        );
        $posts = DB::table('Tbl_Posts')
        ->join('Tbl_Countries','Co_Id','Tbl_Posts.Po_Co_Id')
        ->join('Tbl_Users','Us_Id','Tbl_Posts.Po_Us_Id')->select('Tbl_posts.*','Tbl_Users.*','Tbl_Countries.*')->get();
        $filteredposts = $posts->where('Co_Title',$request->input('body'));
        if($request->input('body')=='')
            return view('posts.chat')->with('posts',$posts)->with($data);
        elseif($filteredposts->count()<1){
            return back()->with('error','no such country');
        }else{
            return view('posts.chat')->with('posts',$filteredposts)->with($data);
        }
    }
}
