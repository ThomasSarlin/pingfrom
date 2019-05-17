@extends('layout.app')
@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>{{$text}}</p>
        {!! Form::open(['action' => 'UserController@getData','method'=>'GET']) !!}
            <div class="form-group">
                {{Form::text('name',$userName,['class'=>'form-control','id'=>'userName'])}}
                {{Form::submit('Search for information!',['class'=>'btn btn-info'])}}
            </div>
        {!! Form::close() !!}
        
    </div>
        @if(!$us_data==null)
            <div class="jumbotron text-center">
                <h1>{{$us_data->value('Us_Name')}}</h1>
                <h2>CLICKS: {{$us_data->value('Us_Clicks')}}</h2>
                <h2><strong>LATEST POSTS</strong></h2>
                @foreach($us_posts as $post)
                        @if($us_data->value('Us_Name')==$userName)
                        <div class="btn-group">
                            <div class="form-group d-inline-block">
                                <div class="btn-group">
                                    {!! Form::open(['action' => 'PostsController@edit','class'=>'form-inline','method'=>'GET','route'=>['posts.edit', $post->Po_Id] ]) !!}
                                    {{$post->created_at}}
                                    {!! Form::hidden('post', $post->Po_Id) !!}
                                    {!! Form::text('body', $post->Po_Body,['class'=>'form-control','id'=>'postForm','placeholder'=>$post->Po_Body,'maxlength'=>'141']) !!}
                                    {{Form::submit('Save',['name'=>'submitbutton','value'=>'Edit','class'=>'btn btn-info btn-inline'])}}
                                    {{Form::submit('Delete',['name'=>'submitbutton','value'=>'Delete','class'=>'btn btn-danger btn-inline'])}}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div><br>
                        @else
                        <h2><strong>{{$post->created_at}}:</strong> {{$post->Po_Body}}</h2>
                        @endif
                @endforeach
            </div>
        @endif
@endsection