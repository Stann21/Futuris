@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Icoon toevoegen
        @endslot
        @slot('link')
            /admin/icon
        @endslot
        @slot('linktext')
        <div class="btn-back">  Terug</div>
        @endslot
    @endcomponent

    <p>Om icoontjes toe te voegen wordt er gebruik gemaakt van Font Awesome. Doormiddel van de 'Unicode' in te voeren en een naam te geven is het mogelijk om het icoontje te gebruiken in de website. <a href="https://fontawesome.com/icons?d=gallery&s=light,regular,solid&m=free" target="_blank">Klik hier om te beijken welke icoontjes je allemaal kunt toevoegen.</a> Het is niet mogelijk om "Brand" icons te gebruiken.</p>

    {{ Form::open(array('action' => 'IconController@store', 'method' => 'POST')) }}

    <div class="form-group">
        {{Form::label('iconname', 'Naam voor Icoon')}}
        {{Form::text('iconname', '', ['class' => 'form-control', 'placeholder' => 'Icoon naam'])}}
    </div>

    <div class="form-group">
         {{Form::label('iconcode', 'Unicode')}}
         {{Form::text('iconcode', '', ['class' => 'form-control', 'placeholder' => 'f26e'])}}
     </div>

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection