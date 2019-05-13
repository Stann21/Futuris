@extends('layouts.backend')

<!--
What does the variable $goal mean?
----------------------------------
0 = Hoofdleerdoel aanpassen
1 = Subleerdoel aanpassen
2 = Template hoofdleerdoel aanpassen
3 = Template subleerdoel aanpassen
-->

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            @if ($name == 'Hoofddoel' || $name == 'Subdoel')
                {{$learninggoal->learning_name}} aanpassen
            @else
                {{$learninggoal->template_name}} aanpassen
            @endif
        @endslot
        @slot('link')
            @switch($name)
                @case('Hoofddoel')
                    /admin/goals/{{$learninggoal->learning_id}}/{{$clientid}}
                    @break
                @case('Subdoel')
                /admin/goals/{{$learninggoal->learning_category}}/{{$clientid}}
                    @break
                @case ('Template Hoofddoel')
                    /admin/goalstemplate/{{$learninggoal->template_id}}
                    @break
                @case ('Template Subdoel')
                    /admin/goalstemplate/{{$learninggoal->template_category}}
                    @break
            @endswitch
        @endslot
        @slot('linktext')
        <div class="btn-back">  Terug</div>
        @endslot
    @endcomponent


    @if ($goal === '0' || $goal === '1')
        {{ Form::open(array('action' => ['LearningGoalsController@update', $learninggoal->learning_id], 'method' => 'post')) }}
    @else
        {{ Form::open(array('action' => ['TemplateLearningGoalsController@update', $learninggoal->template_id], 'method' => 'post')) }}
    @endif

    <!-- Title of the goal -->
    <div class="form-group">
        {{Form::label('name_goal', $name)}}
        @if ($goal === '0' || $goal === '1')
            {{Form::text('name_goal', $learninggoal->learning_name, ['class' => 'form-control', 'placeholder' => $name])}}
        @else
            {{Form::text('name_goal', $learninggoal->template_name, ['class' => 'form-control', 'placeholder' => $name])}}
        @endif
    </div>

    <!-- Description for subgoal -->
    <div class="form-group">
        {{Form::label('description', 'Leerdoel beschrijving')}}
        @if ($goal === '1')
            {{Form::text('description', $learninggoal->learning_description, ['class' => 'form-control', 'placeholder' => 'Beschrijving van het leerdoel'])}}
        @endif
        @if ($goal === '3')
            {{Form::text('description', $learninggoal->template_description, ['class' => 'form-control', 'placeholder' => 'Beschrijving van het leerdoel'])}}
        @endif
    </div>

    <!-- Finish subgoal -->
    @if ($goal === '1')
        <div class="form-group">
            {{Form::label('learning_finished', 'Leerdoel afgerond?')}}
            @if ($learninggoal->learning_finished === 0)
                {{Form::label('learning_finished', 'Ja')}}
                {{Form::radio('finished', '1', false ,array('class'=>'iconSelectedTrue'))}}
                {{Form::label('learning_finished', 'Nee')}}
                {{Form::radio('finished', '0', true ,array('class'=>'iconSelectedTrue'))}}
            @else
                {{Form::label('learning_finished', 'Ja')}}
                {{Form::radio('finished', '1', true ,array('class'=>'iconSelectedTrue'))}}
                {{Form::label('learning_finished', 'Nee')}}
                {{Form::radio('finished', '0', false,array('class'=>'iconSelectedTrue'))}}
            @endif
        </div>
    @endif

    <!-- Show icon for main goals -->
    @if ($goal === '0' || $goal === '2')
        <p>Icon</p>
        <div class="row">
            @foreach ($icons as $icon)
                <div class="col-sm-2">
                    <div class="containerIconEdit">
                    <p>{{$icon->icon_name}}</p>
                    <i class="fa">&#x{{$icon->icon_code}};</i>
                    @if ($goal === '0')
                        @if ($learninggoal->learning_icon == $icon->icon_code)
                            {{Form::radio('icon', $icon->icon_code, true, array('class'=>'iconSelectedTrue'))}}
                        @else
                            {{Form::radio('icon', $icon->icon_code,false,array('class'=>'iconSelected'))}}
                        @endif
                    @else
                        @if ($learninggoal->template_icon == $icon->icon_code)
                            {{Form::radio('icon', $icon->icon_code, true,array('class'=>'iconSelectedTrue'))}}
                        @else
                            {{Form::radio('icon', $icon->icon_code, false,array('class'=>'iconSelected'))}}
                        @endif
                    @endif
                    </div>
                </div>
            @endforeach
        </div> <!-- end row-->
    @endif

    <!-- Just some hidden stuff -->
    @switch ($goal)
        @case ('0')
            {{Form::hidden('category_name', $learninggoal->learning_id)}}
            {{Form::hidden('role', 'Hoofdleerdoel')}}
            {{Form::hidden('userid', $clientid)}}
            {{Form::hidden('finished', $learninggoal->learning_finished)}}
            @break
        @case ('1')
            {{Form::hidden('icon', $learninggoal->learning_icon)}}
            {{Form::hidden('category_name', $learninggoal->learning_category)}}
            {{Form::hidden('userid', $clientid)}}
            @break
        @case ('2')
            {{Form::hidden('category_name', $learninggoal->template_id)}}
            {{Form::hidden('role', 'Hoofdleerdoel')}}
            @break
        @case ('3')
            {{Form::hidden('category_name', $learninggoal->template_category)}}
            {{Form::hidden('icon', $learninggoal->template_icon)}}
            @break
    @endswitch

    <!-- Hidden stuff for everything -->
    {{Form::hidden('goal', $goal)}}
    {{Form::hidden('_method', 'PUT')}}

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}


    <!-- Delete button -->
    @if ($goal === '0' || $goal === '1')
        {{Form::open(array('action' => ['LearningGoalsController@destroy', $learninggoal->learning_id], 'method' => 'delete', 'class'=>'delete')) }}
        {{Form::hidden('userid', $clientid)}}
    @else
        {{Form::open(array('action' => ['TemplateLearningGoalsController@destroy', $learninggoal->template_id], 'method' => 'delete', 'class'=>'delete')) }}
    @endif

    {{Form::submit('Verwijderen', ['class' => 'btn btn-danger'])}}
    {{Form::close() }}

    <!-- Delete confirm -->
    <script>
        $(".delete").on("submit", function(){
            return confirm("Weet je zeker dat je het subdoel wilt verwijderen ");
        });
    </script>
    <!-- End delete confirm -->
@endsection