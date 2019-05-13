@extends('layouts.login')

@section('content')
    <div class="background">
        <div class="container">
            <div class="login-form text-center">
                <img class="img-fluid col-3" src="../images/logo-origineel.png">
                <div class="margin">
                    <h1>Nieuw wachtwoord</h1>
                    {{ Form::open(array('action' => 'ActivateAccountController@store', 'method' => 'POST')) }}

                    {{Form::label('password', 'Wachtwoord')}}
                    {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Wachtwoord'])}}

                    {{Form::label('password_repeat', 'Herhaal wachtwoord')}}
                    {{Form::password('password_repeat', ['class' => 'form-control', 'placeholder' => 'Herhaal wachtwoord'])}}

                    {{Form::hidden('userid', $userid)}}

                    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection