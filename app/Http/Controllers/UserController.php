<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
class UserController extends Controller
{
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

        //Save Minimal user as Cookie
        Cookie::queue('userName',$request->input('name'),time() + (86400 * 30));
        return redirect('/ping');
    }

}