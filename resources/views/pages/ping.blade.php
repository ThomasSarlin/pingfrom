@extends('layout.app')
@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        {!! Form::open(['action' => 'PingsController@store','method'=>'POST']) !!}
            <div class="form-group">
                {{Form::submit('CLICK!',['class'=>'btn btn-info formButton'])}}
            </div>
        {!! Form::close() !!}
    </div>
@endsection