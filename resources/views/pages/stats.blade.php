@extends('layout.app')
@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>{{$text}}</p>
        @if(count($pings)>0)
            @foreach($pings as $ping)
                <div>
                    <h2>{{$ping->country}}<strong> {{$ping->pings}}</h2>
                </div>
            @endforeach
        @endif
    </div>
@endsection