@extends('layouts.backend')

<!-- What does ID mean?
0 = Create client
1 = Create mentor
-->

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Account aanmaken
        @endslot
        @slot('link')
            /admin/user
        @endslot
        @slot('linktext')
           <div class="btn-back"> Terug</div>
        @endslot
    @endcomponent

    {{ Form::open(array('action' => 'UsersController@store', 'method' => 'POST')) }}
    <div class="form-group">
        {{Form::label('username', 'Naam deelnemer')}}
        {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Naam'])}}
    </div>

    @if($id == '0')
        <div class="form-group">
            {{Form::label('endgoal', 'Einddoel')}}
            {{Form::text('endgoal', '', ['class' => 'form-control', 'placeholder' => 'Einddoel'])}}
        </div>

        <!-- Assign a mentor -->
        {{Form::label('mentor', 'Begeleider')}}
        <div class="form-group">
            <div class="row">
                @foreach($mentor as $name)
                    <div class="col-sm-2">
                        {{Form::label('mentor', $name->username)}}
                        {{Form::radio('mentor', $name->id, true,array('class'=>'iconSelectedTrue'))}}
                    </div>
                @endforeach
            </div><!-- End row -->
        </div>

        <!-- Template selector -->
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">{{Form::label('template', 'Template')}}</div>
                @foreach ($templates as $template)
                    <div class="col-sm-4 form-group">
                        <div class="templateGroup">
                            {{Form::checkbox('template[]', $template->template_name, '',array('class'=>'iconSelectedTrue'))}}
                            {{$template->template_name}}
                            {!! App\template_goals::CreateUserTemplates($template->template_id) !!}
                        </div>
                    </div>
                @endforeach
            </div><!--End row-->
        </div>

        <div class="form-group">
            {{Form::label('feedback', 'Hoe kan de deelnemer feedback geven?')}}
            <div class="row">
                <div class="col-sm-4">
                    <p>Smiley</p>
                    <i class="far fa-smile"></i>
                    <i class="far fa-meh-blank"></i>
                    <i class="far fa-frown"></i>
                    {{Form::radio('feedback', '1',true,array('class'=>'iconSelectedTrue'))}}
                </div>
                <div class="col-sm-4">
                    <p>Duimen</p>
                    <i class="far fa-thumbs-up"></i>
                    <i class="far fa-thumbs-down"></i>
                    {{Form::radio('feedback', '2',false,array('class'=>'iconSelectedTrue'))}}
                </div>
                <div class="col-sm-4">
                    <p>Cijfers dropdown</p>
                    {{Form::selectRange('number', 1, 5)}}
                    {{Form::radio('feedback', '3',false,array('class'=>'iconSelectedTrue'))}}
                </div>
            </div> <!-- End row -->
        </div>
    @endif

    @if ($id == '1')
        <div class="form-group">
            {{Form::label('password', 'Wachtwoord')}}
            {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Wachtwoord'])}}
        </div>
        <div class="form-group">
            {{Form::password('password_repeat', ['class' => 'form-control', 'placeholder' => 'Wachtwoord herhaling'])}}
        </div>
    @endif

    {{Form::hidden('id', $id)}}

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection