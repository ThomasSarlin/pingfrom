<?php
    //Save information about country
    $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".'UserController@getIp');
    $country = (string)$xml->geoplugin_countryName;
    Cookie::queue('country',$country, time() + (86400 * 30));
?>
@extends('layout.app')
@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>{{$text}}</p>
        {!! Form::open(['action' => 'UserController@store','method'=>'POST']) !!}
            <div class="form-group">
                {{Form::text('name',$placeholder,['class'=>'form-control','id'=>'userName','placeholder'=>'Anonymous'])}}
                {{Form::submit('Start pinging!',['class'=>'btn btn-info'])}}
            </div>
        {!! Form::close() !!}
    </div>
@endsection