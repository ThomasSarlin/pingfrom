<?php

namespace App\Http\Controllers;
use Cookie;
use App\Ping;
use DB;
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
            'title2' => 'Top Users!',
            'text' => 'Embark upon a magical statistic jouney!',
            'buttonText' => 'Update'
        );
        $us_clicks= DB::table('Tbl_Users')->orderBy('Us_Clicks','desc')->get();
        $co_clicks = DB::table('Tbl_Countries')->orderBy('Co_Clicks','desc')->get();
        return view('pages.stats')->with($data)->with('co_clicks',$co_clicks)->with('us_clicks',$us_clicks);
    }

    public function sort(Request $request){
        $data =array(
            'title' => 'Top Countries!',
            'title2' => 'Top Users!',
            'text' => 'Embark upon a magical statistic jouney!',
            'buttonText' => 'Update'
        );
        $co_clicks= DB::table('Tbl_Countries')->orderBy('Co_Clicks','desc')->get();
        $us_clicks = DB::table('Tbl_Users')->orderBy('Us_Clicks','desc')->get();
        switch($request->input('OrderCoBy')){
            case 0:
                $co_clicks = DB::table('Tbl_Countries')->orderBy('Co_Clicks','desc')->get();
                break;
            case 1:
                $co_clicks = DB::table('Tbl_Countries')->orderBy('Co_Clicks','asc')->get();
                break;
        }
        switch($request->input('OrderUsBy')){
            case 0:
                $us_clicks = DB::table('Tbl_Users')->orderBy('Us_Clicks','desc')->get();
                break;
            case 1:
                $us_clicks = DB::table('Tbl_Users')->orderBy('Us_Clicks','asc')->get();
                break;
        }
        return view('pages.stats')->with($data)->with('us_clicks',$us_clicks)->with('co_clicks',$co_clicks);
    }
}
