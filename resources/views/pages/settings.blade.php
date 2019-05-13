@extends('layouts.app')

@section('content')
    <div class="col-lg-8 col-md-8 col-sm-10 col-12 offset-lg-2 offset-md-2 offset-sm-1 settings body-container">
        <h1 class="text-left kop-text">Algemeen</h1>
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-sm-10 col-12">
                <div class="row">
                    <div class="user">
                        <span><i class="fas fa-user"></i></span>
                    </div>
                    <h2 class="offset-1">{{$userid->username}}</h2>
                </div>
            </div>

            {{ Form::open(array('action' => ['PagesController@passwordUpdate', $userid->id], 'method' => 'POST', 'class' => 'col-lg-8 col-md-8 col-sm-10 col-12')) }}

            <label for="user"><i class="fas fa-user"></i> {{$userid->username}}</label><br>
            <label class="password" for="password"><i class="fas fa-key"></i> Oud wachtwoord</label><br>
            {{Form::password('old_password', ['class' => 'col-12', 'placeholder' => 'Oud wachtwoord'])}}
            <label class="password" for="password"><i class="fas fa-key"></i> Nieuw wachtwoord</label><br>
            {{Form::password('new_password', ['class' => 'col-12', 'placeholder' => 'Nieuw wachtwoord'])}}
            <label class="password" for="password"><i class="fas fa-key"></i> Herhaal nieuw wachtwoord</label><br>
            {{Form::password('repeat_password', ['class' => 'col-12', 'placeholder' => 'Herhaal nieuw wachtwoord'])}}

            {{Form::submit('Opslaan', ['class' => 'button'])}}
            {{ Form::close() }}

        </div>

    </div>
@endsection