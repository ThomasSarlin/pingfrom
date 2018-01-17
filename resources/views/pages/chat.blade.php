@extends('layout.app')
@section('content')
    <div class="form-group">
        <label for="comment">{{$fieldText}}</label>
        <textarea class="form-control" rows="2" id="comment" maxlength="100" width="100px"></textarea>
        <button for="comment">{{$buttonText}}</button>
    </div>
@endsection