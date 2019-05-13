@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Achievement aanpassen
        @endslot
        @slot('link')
            /admin/achievement
        @endslot
        @slot('linktext')
        <div class="btn-back">  Terug</div>
        @endslot
    @endcomponent

    {{ Form::open(array('action' => ['AchievementController@update', $achievements->id], 'method' => 'POST', 'enctype' => 'multipart/form-data')) }}

    <div class="form-group">
        {{Form::text('achievements_title', $achievements->achievements_title, ['class' => 'form-control', 'placeholder' => 'Photoshop basis kunnen'])}}
    </div>

    <div class="form-group">
        {{Form::text('achievements_description', $achievements->achievements_description, ['class' => 'form-control', 'placeholder' => 'Achievement beschrijving'])}}
    </div>

    <!-- Img upload -->
    <div class="form-group">
        {{Form::file('achievements_img',['class' => 'btn-upload-file'])}}
    </div>
  
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
       
    {{ Form::close() }}

    <div class="form-group">
        {{Form::open(array('action' => ['AchievementController@destroy', $achievements->id], 'method' => 'delete', 'class'=>'delete')) }}
        {{Form::submit('Verwijderen', ['class' => 'btn btn-danger'])}}
        {{Form::close() }}
    </div>
    <a href="/admin/achievement">Terug</a>
    <!-- Delete confirm -->
    <script>
    $(".delete").on("submit", function(){
        return confirm("Weet je zeker dat je deze achievement wil verwijderen");
    });
    </script>
@endsection