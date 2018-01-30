<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ping;
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
        $pingCount=0;
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
        $country=Cookie::get('country');
        $ping = DB::table('pings')->where('country',$country)->count();;
        if($ping==0){
            $ping=new Ping;
            $ping->country=$country;
            $ping->pings=1;
            $ping->save();
        }else{
            DB::table('pings')->where('country',$country)->increment('pings',1);
        }
        return redirect('/ping')->with('success',PingsController::getPingInfo());
    }
    private function getPingInfo(){
        $country=Cookie::get('country');
        $pings=Ping::where('country',$country)->value('pings');
        return 'Click sent! '.$country." has ".$pings.' clicks!';
    }
}
