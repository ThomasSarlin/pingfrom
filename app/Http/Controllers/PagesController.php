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
        $data = array(
            'title'=>'Welcome to the Chat',
            'text' => 'Here you can represent your country in a fierce discussion',
            'buttonText' =>'Send reply',
            'fieldText' =>'Apply creative message:'
        );
        return view('pages.chat')-with($data);
    }
    public function stats(){
        $data =array(
            'title' => 'Statistics overview!',
            'text' => 'Embark upon a magical statistic jouney!',
            'buttonText' => 'Update'
        );
        return view('pages.stats')->with($data);
    }
    public function ping(){
        $data = array(
            'title'=>'Add your ping'
        );
        return view('pages.ping')->with($data);
    }
}
