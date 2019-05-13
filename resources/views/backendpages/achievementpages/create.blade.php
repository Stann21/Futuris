@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
           Achievement template aanmaken
        @endslot
        @slot('link')
            /admin/achievement
        @endslot
        @slot('linktext')
        <div class="btn-back">  Terug</div>
        @endslot
    @endcomponent

    {{ Form::open(array('action' => 'AchievementController@store', 'method' => 'POST','enctype'=>'multipart/form-data')) }}

    <div class="form-group">
        {{Form::label('achievements_title', 'Naam Achievement')}}
        {{Form::text('achievements_title', '', ['class' => 'form-control', 'placeholder' => 'Naam Achievement'])}}
    </div>

    <div class="form-group">
        {{Form::label('achievements_description', 'Description Achievement')}}
        {{Form::text('achievements_description', '', ['class' => 'form-control', 'placeholder' => 'Beschrijving Achievement'])}}
    </div>

    <div class="form-group">
        {{Form::label('achievements_img', 'Icon Achievement')}}
        {{Form::file('achievements_img')}}
    </div>


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection