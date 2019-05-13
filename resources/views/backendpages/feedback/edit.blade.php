@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Feedback aanpassen
        @endslot
        @slot('link')
            @switch ($id)
                @case ('0')
                    admin/feedback
                    @break
                @case ('1')
                    admin/user/{{$feedback->feedback_client}}
                    @break
            @endswitch
        @endslot
        @slot('linktext')
        <div class="btn-back"> Terug</div>
        @endslot
    @endcomponent

    {{ Form::open(array('action' => ['FeedbackController@update', $feedback->feedback_id], 'method' => 'PUT')) }}
    <div class="form-group">
        {{Form::label('feedback', 'Feedback aanpassen')}}
        {{Form::textarea('feedback', $feedback->feedback_description, ['class' => 'form-control', 'placeholder' => 'Feedback beschrijving'])}}
    </div>

    <!-- Some hidden stuff -->
    {{Form::hidden('userid', $feedback->feedback_client)}}
    {{Form::hidden('location', $locationid)}}

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{Form::close() }}
@endsection