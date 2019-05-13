@extends('layouts.login')

@section('content')
    <div class="background">
        <div class="container">
            <div class="login-form text-center">
                <img class="img-fluid col-3" src="images/logo-origineel.png">
                <div class="margin">
                    <h1>{{$title}}</h1>
                    <!-- activateCheck -->
                    {{Form::open(array('action' => 'ActivateAccountController@activateCheck', 'method' => 'POST')) }}

                    {{Form::label('username', 'Naam')}}
                    {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'John Doe'])}}

                    {{Form::label('code', 'Activerings code')}}
                    {{Form::text('code', '', ['class' => 'form-control', 'placeholder' => '12345678'])}}

                    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    <a class="btn btn-link btn-margin link" href="/login">
                        Terug
                    </a>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection