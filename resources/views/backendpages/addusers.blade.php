@extends('layouts.backend')

@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        {{ Form::open(array('url' => 'foo/bar')) }}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        {{ Form::close() }}

    </div>
@endsection