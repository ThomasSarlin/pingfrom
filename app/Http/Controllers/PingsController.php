<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use DB;
use Cookie;
class PingsController extends Controller
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
            'title'=>'CLICK to represent your country!',
            'buttonText' => 'CLICK'
        );
        return view('pages.ping')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('Tbl_Countries')->where('Co_Title',Cookie::get('country'))->increment('Co_Clicks',1);
        DB::table('Tbl_Users')->where('Us_Name',Cookie::get('userName'))->increment('Us_Clicks',1);
        return back()->with('success',PingsController::getClickInfo());
    }
    private function getClickInfo(){
        $country=Cookie::get('country');
        $clicks=DB::table('Tbl_Countries')->where('Co_Title',$country)->value('Co_Clicks');
        return 'Click sent! '.$country." has ".$clicks.' clicks!';
    }
    
}
