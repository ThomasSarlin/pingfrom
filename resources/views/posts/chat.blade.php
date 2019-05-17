@extends('layout.app')
@section('content') 
    
    {!! Form::open(['class'=>'form-inline','action' => 'PostsController@filter','method'=>'GET']) !!}
        <div class="form-group d-inline-block ">
                Filter by country:
                {{Form::text('body','',['width'=>'100px','class'=>'form-control ','autofocus'=>'autofocus','id'=>'postForm','placeholder'=>'Country..','maxlength'=>'141'])}}
                {{Form::submit('Filter',['class'=>'btn btn-info btn-inline'])}}
        </div>
        {!! Form::close() !!}
    <div class="chatPanel">
        
        @if(count($posts)>0)
            @foreach($posts as $post)
                <div>
                    <h5><b></b><strong>{{$post->Us_Name}} @ {{$post->Co_Title}}</strong>: {{$post->Po_Body}}</h5>
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