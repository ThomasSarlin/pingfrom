@extends('layout.app')
@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>{{$text}}</p>
        <a href="/ping" class="btn btn-info" role="button">{{$buttonText}}</a>
    </div>
@endsection