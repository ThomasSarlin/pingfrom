@extends('layout.app')
@section('content')
    <div class="text-center"><h1>{{$text}}</h1></div>
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        {!! Form::open(['action' => 'PagesController@sort','method'=>'GET']) !!}
        <div class="form-group">
                {{Form::select('OrderCoBy', array(
                    'Descending',
                    'Ascending'
                ))}}
            {{Form::submit('Sort',['class'=>'btn btn-info formButton'])}}
        </div>
        @if(count($co_clicks)>0)
            @foreach($co_clicks as $click)
                <div>
                    <h2>{{$click->Co_Title}}<strong> {{$click->Co_Clicks}} clicks</h2>
                </div>
            @endforeach
        @endif
    </div>
    <div class="jumbotron text-center">
            <h1>{{$title2}}</h1>
            <div class="form-group">
                    {{Form::select('OrderUsBy', array(
                        'Decending',
                        'Ascending'
                    ))}}
                {{Form::submit('Sort',['class'=>'btn btn-info formButton'])}}
            </div>
            {!! Form::close() !!}
            @if(count($us_clicks)>0)
                @foreach($us_clicks as $click)
                    <div>
                        <h2>{{$click->Us_Name}}<strong> {{$click->Us_Clicks}} clicks</h2>
                    </div>
                @endforeach
            @endif
        </div>
@endsection