<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use App\SimpleUser;
use DB;
class UserController extends Controller
{

    public function index(Request $request){
        $data = array(
            'title'=>'User Info',
            'text' => 'Select user to see clicks and posts!',
            'userName'=> Cookie::get('userName')
        );
        $userdata=null;
        $userposts=null;
        return view('pages.userinfo')
        ->with($data)
        ->with('us_data',$userdata)
        ->with('us_posts',$userposts);
    }
    public function getIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){$ip=$_SERVER['HTTP_CLIENT_IP'];}
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];}
        else{$ip=$_SERVER['REMOTE_ADDR'];}
        return $ip;
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
            'name'=>'required'
        ]);
        $userName=$request->input('name');
        $countryName=$request->input('country');
        if(DB::table('Tbl_Countries')->where('Co_Title',$countryName)->count()<1){
            DB::table('Tbl_Countries')->insert(
                ['Co_Title'=>$countryName,
                'Co_Clicks'=>'0',
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
                ]);
        }
        $country=DB::table('Tbl_Countries')->where('Co_Title',$countryName)->get();
        $countryKey=DB::table('Tbl_Countries')
        ->where('Co_Title',$countryName)->value('Co_id');

        //Save Minimal user as Cookie
        Cookie::queue('userName',$userName,time() + (86400 * 30));
        //Add user to Table
        if( DB::table('Tbl_Users')->where('Us_Name',$userName)->count()<1){
            DB::table('Tbl_Users')->insert([
                'Us_Name'=>$userName,'Us_Co_Id'=>$countryKey,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
                'Us_Clicks' =>'0'
            ]);
        }
        $user= DB::table('Tbl_Users')->where('Us_Name',$userName)->get();
        return redirect('/ping')->with('country',$countryKey);
    }

    public function getData(Request $request){
        $data = array(
            'title'=>'User Info',
            'text' => 'Select user to see clicks and posts!',
            'userName'=> Cookie::get('userName')
        );
        $this->validate($request,[
            'name'=>'required'
        ]);
        $name = $request->input('name');
        if(DB::table('Tbl_Users')->where('Us_Name',$name)->count()<1){
            return back()->with('error',$name.(' does not seem to exist in our servers'));
        }
        $userdata = DB::table('Tbl_Users')->where('Us_Name',$name);
        $userposts = DB::table('Tbl_Posts')->where('Po_Us_Id',$userdata->value('Us_Id'))->orderBy('created_at','desc')->get();
        
        return view('pages.userinfo')
        ->with($data)
        ->with('us_data',$userdata)
        ->with('us_posts',$userposts);
    }
}