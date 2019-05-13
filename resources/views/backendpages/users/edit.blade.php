@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Deelnemer aanpassen
        @endslot
        @slot('link')
            /admin/user/{{$users->id}}
        @endslot
        @slot('linktext')
        <div class="btn-back"> Terug</div>
        @endslot
    @endcomponent

    {{ Form::open(array('action' => ['UsersController@update', $users->id], 'method' => 'post')) }}
    <div class="form-group">
         {{Form::label('username', 'Naam gebruiker')}}
        {{Form::text('username', $users->username, ['class' => 'form-control', 'placeholder' => 'John Doe'])}}
    </div>

    <div class="form-group">
        {{Form::label('endgoal', 'Einddoel')}}
        {{Form::text('endgoal', $users->user_endgoal, ['class' => 'form-control', 'placeholder' => 'Designer'])}}
    </div>

    {{Form::label('mentor', 'Begeleider')}}
    <div class="form-group">
        <div class="row">
            @foreach($mentor as $name)
                <div class="col-sm-2">
                    {{Form::label('mentor', $name->username)}}
                    @if($users->user_mentor == $name->id)
                        {{Form::radio('mentor', $name->id, true,array('class'=>'iconSelectedTrue'))}}
                        @else
                        {{Form::radio('mentor', $name->id,false,array('class'=>'iconSelectedTrue'))}}
                    @endif
                </div>
            @endforeach
        </div><!-- End row -->
    </div>

    <div class="form-group">
        {{Form::label('feedback', 'Hoe kan de client feedback geven?')}}
        <div class="row">
            <div class="col-sm-4">
                <p>Smiley</p>
                <i class="far fa-smile"></i>
                <i class="far fa-meh-blank"></i>
                <i class="far fa-frown"></i>
                @if ($users->user_feedback == '1')
                    <p>{{Form::radio('feedback', '1', true, array('class'=>'iconSelectedTrue'))}}</p>
                @else
                   <p>{{Form::radio('feedback', '1',false, array('class'=>'iconSelected'))}}</p>
                @endif
            </div>
            <div class="col-sm-4">
                <p>Duimen</p>
                <i class="far fa-thumbs-up"></i>
                <i class="far fa-thumbs-down"></i>
                @if ($users->user_feedback == '2')
                    <p>{{Form::radio('feedback', '2', true, array('class'=>'iconSelectedTrue'))}}</p>
                @else
                    <p>{{Form::radio('feedback', '2', false, array('class'=>'iconSelected'))}}</p>
                @endif            </div>
            <div class="col-sm-4">
                <p>Cijfers dropdown</p>
                {{Form::selectRange('number', 1, 5)}}
                @if ($users->user_feedback == '3')
                    <p>{{Form::radio('feedback', '3', true, array('class'=>'iconSelectedTrue'))}}</p>
                @else
                    <p>{{Form::radio('feedback', '3', false, array('class'=>'iconSelected'))}}</p>
                @endif            </div>
        </div> <!-- End row -->
    </div>

    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}


    {{ Form::open(array('action' => ['UsersController@destroy', $users->id], 'method' => 'delete', 'class'=>'delete')) }}
    {{Form::hidden('userid', $users->userid)}}
    {{Form::submit('Verwijderen', ['class' => 'btn btn-danger'])}}
    {{Form::close() }}
    <a href="/admin/user/{{$users->id}}">Terug</a>

    <!-- Delete confirm -->
    <script>
        $(".delete").on("submit", function(){
            return confirm("Weet je zeker dat je gebruiker '{{$users->username}}' wilt verwijderen? Je verwijderd hiermee ook de leerdoelen en feedback van '{{$users->username}}.");
        });
    </script>
    <!-- End delete confirm -->
@endsection