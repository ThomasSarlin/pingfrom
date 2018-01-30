@extends('layout.app')
@section('content')
    <div class="chatPanel">
        @if(count($posts)>0)
            @foreach($posts as $post)
                <div>
                    <h5><b>[{{$post->created_at->format('Y-m-d h:m')}}]</b><strong> {{$post->userName}} @ {{$post->country}}</strong>: {{$post->body}}</h5>
                </div>
            @endforeach
        @else
            No posts found
        @endif
    </div>
    {!! Form::open(['action' => 'PostsController@store','method'=>'POST']) !!}
    <div class="form-group">
        {{Form::text('body','',['class'=>'form-control','autofocus'=>'autofocus','id'=>'postForm','placeholder'=>'Text..','maxlength'=>'141'])}}
        {{Form::submit('Send message!',['class'=>'btn btn-info'])}}
    </div>
    {!! Form::close() !!}
@endsection