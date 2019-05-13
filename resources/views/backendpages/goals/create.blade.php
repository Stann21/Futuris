@extends('layouts.backend')

<!--
What does the variable $goal mean?
----------------------------------
0 = Hoofddoel aanmaken
1 = Subdoel aanmaken
2 = Template hoofdleerdoel aanmaken
3 = Template subleerdoel aanmaken
-->

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            {{$name}} aanmaken
        @endslot
        @slot('link')
            @switch($name)
                @case('Hoofddoel')
                    /admin/user/{{$clientid}}
                    @break
                @case('Subdoel')
                    /admin/user/{{$clientid}}
                    @break
                @case ('Template Hoofddoel')
                    /admin/goalstemplate
                    @break
                @case ('Template Subdoel')
                    /admin/goalstemplate/{{$learninggoal->template_id}}
                    @break
            @endswitch
        @endslot
        @slot('linktext')
        <div class="btn-back">  Terug</div>
        @endslot
    @endcomponent

    <!-- Open the form -->
    @if ($goal === '2' || $goal === '3')
        {{ Form::open(array('action' => 'TemplateLearningGoalsController@store', 'method' => 'POST')) }}
    @else
        {{ Form::open(array('action' => 'LearningGoalsController@store', 'method' => 'POST')) }}
    @endif

        <!--Name of goal & role of goal -->
        <div class="form-group">
            {{Form::label('name_goal', 'Naam ' . $name)}}
            {{Form::text('name_goal', '', ['class' => 'form-control', 'placeholder' => 'Naam ' . $name])}}
        </div>

        {{Form::hidden('role', $name)}}

    @if ($name === 'Subdoel' || $name === 'Template Subdoel')
        <!-- Description and category name -->
        <div class="form-group">
            {{Form::label('description', 'Leerdoel beschrijving')}}
            {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Beschrijving van het leerdoel'])}}
         </div>

        <div class="form-group">
            {{Form::hidden('category_name', $goalid)}}
        </div>
    @endif

    <!-- Add icon picker -->
    @if ($name === 'Hoofddoel' || $name === 'Template Hoofddoel')
    <p>Icon</p>
    <div class="row">
        @foreach ($icons as $icon)
            <div class="col-sm-2">
                    <div class="containerIconEdit">
                <p>{{$icon->icon_name}}</p>
                <i class="fa">&#x{{$icon->icon_code}};</i>
                {{Form::radio('icon', $icon->icon_code, false ,array('class'=>'iconSelectedTrue'))}}
            </div>
            </div>
        @endforeach
    </div> <!-- end row-->

    <!-- Does the goal end? -->
    <div class="form-group">
    <p>Kan het leerdoel eindigen?</p>
        {{Form::label('ending', 'Ja')}}
        {{Form::radio('ending', '0',false,array('class'=>'iconSelected'))}}
        {{Form::label('ending', 'Nee')}}
        {{Form::radio('ending', '1',false,array('class'=>'iconSelected'))}}
    </div>
    @endif

    <!-- Add icon to subgoal -->
        @if ($goal === '1')
            {{Form::hidden('icon', $learninggoal->learning_icon)}}
            {{Form::hidden('ending', $learninggoal->learning_finish)}}
        @endif

        @if ($goal === '3')
            {{Form::hidden('icon', $learninggoal->template_icon)}}
            {{Form::hidden('ending', $learninggoal->template_finish)}}
        @endif

    <!-- Add clientid -->
    @if ($goal === '0' || $goal === '1')
        {{Form::hidden('userid', $clientid)}}
    @endif


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection