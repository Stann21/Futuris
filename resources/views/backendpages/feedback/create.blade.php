@extends('layouts.backend')
<!--
What does $id/feedback_role mean
0 = Feedback on client
1 = Feedback on subgoal
-->

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Geef feedback
        @endslot
        @slot('link')
            @switch ($id)
                @case ('0')
                    /admin/user/{{$userid}}
                @break
                @case ('1')
                    /admin/goals/{{$maingoal->learning_id}}/{{$userid}}
                @break
            @endswitch
        @endslot
        @slot('linktext')
        <div class="btn-back">     Terug</div>
        @endslot
    @endcomponent

    {{ Form::open(array('action' => 'FeedbackController@store', 'method' => 'POST')) }}
    <div class="form-group">
        {{Form::label('feedback', 'Feedback')}}
        {{Form::textarea('feedback', '', ['class' => 'form-control', 'placeholder' => 'Feedback beschrijving'])}}
    </div>

    <!-- Some hidden stuff -->
    {{Form::hidden('userid', $userid)}}
    {{Form::hidden('feedback_role', $id)}}
    {{Form::hidden('feedback_onid', $feedbackid)}}


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection