@extends('layouts.backend')

@section('content')
<div class="wrapperUserFeedback">
    <div class="row">
        <div class="col-sm-2"><p class="titleBackendHomepage">Datum</p></div>
        <div class="col-sm-2"><p class="titleBackendHomepage">Gebruiker</p></div>
        <div class="col-sm-4"><p class="titleBackendHomepage">Feedback</p></div>
        <div class="col-sm-1"><p class="titleBackendHomepage">Soort feedback</p></div>
        <div class="col-sm-2"></div>
    </div> <!-- End row -->

    <div class="row">
        @foreach($feedback as $comments)
            <div class="col-sm-2">{{ \Carbon\Carbon::parse($comments->feedback_date)->format('d-m-Y')}}</div>
            <div class="col-sm-2">
                @foreach ($users as $user)
                    @if ($comments->feedback_client == $user->id)
                        {{$user->username}}
                    @endif
                @endforeach
            </div>
            <div class="col-sm-4">{{$comments->feedback_description}}</div>
            <div class="col-sm-1">{{App\feedback::FeedbackTag($comments->feedback_id)}} </div>

            <div class="col-sm-3"> <a href="feedback/{{$comments->feedback_id}}/edit/0"> <div class="btn-change">Aanpassen</div></a> |
            {{Form::open(array('action' => ['FeedbackController@destroy', $comments->feedback_id], 'method' => 'delete', 'class'=>'delete')) }}
            {{Form::submit('Verwijderen', ['class' => 'btn btn-danger'])}}
            {{Form::close() }}
            </div>
        @endforeach

        <div class="row">
            <div class="col-sm-12">
                {{$feedback->links()}}
            </div>
        </div>
    </div>
        <!-- Delete confirm -->
            <script>
                $(".delete").on("submit", function(){
                    return confirm("Weet je zeker dat je deze feedback wilt verwijderen?");
                });
            </script>
            <!-- End delete confirm -->
    </div> <!-- End row -->
@endsection