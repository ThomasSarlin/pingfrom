<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $data = array(
            'title'=>'Welcome to WhatWhere?',
            'text' =>'a simple ping contest for the world, be amazed.',
            'buttonText' => 'start pinging'
        );
        return view('pages.index')->with($data);
    }
    public function chat(){
        return view('pages.chat');
    }
    public function stats(){
        return view('pages.stats');
    }
    public function ping(){
        $data = array(
            'title'=>'Add your ping'
        );
        return view('pages.ping')->with($data);
    }
}
