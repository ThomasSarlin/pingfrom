<?php

namespace App\Http\Controllers;
use Cookie;
use App\Ping;
use Session;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $data = array(
            'title'=>'Welcome to ClickWars',
            'text' =>'a simple ping contest for the world, be amazed.',
            'placeholder'=>PagesController::getPlaceHolder(),
            'buttonText' => 'start pinging'
        );
        return view('pages.index')->with($data);
    }
    public function getPlaceHolder(){
        if(Cookie::get('userName')==null){
            return 'Anonymous';
        }
        return Cookie::get('userName');
    }
    public function stats(){
        if(Cookie::get('userName')==null){
            return redirect('/')->with('error','Set nickname to proceed');
        }
        $data =array(
            'title' => 'Top Countries!',
            'text' => 'Embark upon a magical statistic jouney!',
            'buttonText' => 'Update'
        );
        $pings = Ping::orderBy('pings','desc')->get();
        return view('pages.stats')->with($data)->with('pings',$pings);
    }
}
