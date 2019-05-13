@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            PDF converter
        @endslot
        @slot('link')
            /admin/user
        @endslot
        @slot('linktext')
        <div class="btn-back">   Terug</div>
        @endslot
    @endcomponent

    {{Form::open(array('action' => 'PrintController@pdf', 'method' => 'POST')) }}

    @foreach($feedback as $item)
        <div class="form-group">
            <p>{{App\learning_goals::GetFeedbackGoal($item->feedback_onid)}}</p>
            <p>{{$item->feedback_description}}</p>
            {{Form::checkbox('feedback[]', $item->feedback_id, true)}}
        </div>
    @endforeach

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{Form::close()}}
@endsection