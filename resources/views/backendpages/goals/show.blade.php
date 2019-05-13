@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            @if ($name == 'Leerdoel')
                {{$goals->learning_name}}
            @else
                {{$goals->template_name}}
            @endif
        @endslot
        @slot('link')
            @if ($name == 'Leerdoel')
                /admin/user/{{$userid}}
            @else
                /admin/goalstemplate
            @endif
        @endslot
        @slot('linktext')
        <div class="btn-back">  Terug</div>
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-sm-2">
            <i class="fa">@if ($name =='Leerdoel')&#x{{$goals->learning_icon}};@else&#x{{$goals->template_icon}};@endif</i>
        </div>
            @if ($name =='Leerdoel')
                <div class="col-sm-4">
                    {{$goals->learning_name}}
                </div>
            @else
                <div class="col-sm-6">
                    {{$goals->template_name}}
                </div>
            @endif
        <div class="col-sm-2">
            @if ($name == 'Leerdoel')
                <a href="/admin/goals/edit/{{$userid}}/0/{{$goals->learning_id}}">Aanpassen</a></div>
                @else
                <a href="/admin/goalstemplate/edit/{{$goals->template_id}}/2">Aanpassen</a></div>
            @endif

            @if ($name == 'Leerdoel')
                <div class="col-sm-2">
                    <a href="/admin/achievement/user/create/{{$userid}}/1/{{$goals->learning_id}}">Geef achievement</a>
                </div>
            @endif

        <div class="col-sm-2">
            @if ($name == 'Leerdoel')
                {{Form::open(array('action' => ['LearningGoalsController@destroy', $goals->learning_id], 'method' => 'delete', 'class'=>'delete')) }}
                {{Form::hidden('userid', $userid)}}
            @else
                {{Form::open(array('action' => ['TemplateLearningGoalsController@destroy', $goals->template_id], 'method' => 'delete', 'class'=>'delete')) }}
            @endif
            {{Form::submit('Verwijderen', ['class' => 'btn btn-danger'])}}
            {{Form::close() }}
        </div>
    </div> <!-- End row -->

    <!-- Delete confirm -->
    <script>
        $(".delete").on("submit", function(){
            return confirm("Weet je zeker dat je het leerdoel en alle subdoelen wilt verwijderen?");
        });
    </script>
    <!-- End delete confirm -->

    <div class="row">
        <div class="col-sm-6"><h2>Subdoelen</h2></div>
            <div class="col-sm-6">
                @if ($name == 'Leerdoel')
                <div class="btn-back"> <a href="/admin/goals/create/{{$userid}}/1/{{$goals->learning_id}}">Maak subdoel aan</a></div>
                    @else
                    <div class="btn-back"> <a href="/admin/goalstemplate/create/3/{{$goals->template_id}}">Maak subdoel aan</a></div>
                @endif
            </div>
    </div><!-- End row -->

    <hr>
    <div class="row">
        <!-- If its Leerdoel then there should be a different column size -->
        @if ($name == 'Leerdoel')
            <div class="col-sm-5">Leerdoel</div>
            <div class="col-sm-2">Beoordeling</div>
            <div class="col-sm-1">Aanpassen</div>
            <div class="col-sm-2">Feedback</div>
            <div class="col-sm-2">Achievements</div>
        @else
            <div class="col-sm-8">Naam</div>
            <div class="col-sm-4">Aanpassen</div>
        @endif

        @foreach($subgoals as $subgoal)
            @if ($name =='Leerdoel')
                    <div class="col-sm-5"><p><i class="fa">&#x{{$goals->learning_icon}};</i> {{$subgoal->learning_name}}</p>{{$subgoal->learning_description}}</div>
                @else
                    <div class="col-sm-8"><p><i class="fa">&#x{{$goals->template_icon}};</i>{{$subgoal->template_name}}</p>{{$subgoal->template_description}}</div>
            @endif


        <!-- Only Leerdoel can be finished, a template can't be finished -->
        @if ($name == 'Leerdoel')
            <div class="col-sm-2">
            @if ($subgoal->learning_finished === 1)
                <p>Afgerond</p>
            @else
                <p>Niet afgerond</p>
            @endif
            </div>
        @endif

        @if ($name == 'Leerdoel')
            <div class="col-sm-1">
                <a href="/admin/goals/edit/{{$userid}}/1/{{$subgoal->learning_id}}">Aanpassen</a>
            </div>
        @else
            <div class="col-sm-4">
                <a href="/admin/goalstemplate/edit/{{$subgoal->template_id}}/3">Aanpassen</a>
            </div>
        @endif

        @if ($name == 'Leerdoel')
            <div class="col-sm-2">
                <a href="/admin/feedback/create/{{$userid}}/1/{{$subgoal->learning_id}}">Geef feedback</a>
            </div>
            <div class="col-sm-2">
                <a href="/admin/achievement/user/create/{{$userid}}/2/{{$subgoal->learning_id}}">Geef achievement</a>
            </div>
        @endif

        @endforeach
    </div> <!-- end row -->
@endsection