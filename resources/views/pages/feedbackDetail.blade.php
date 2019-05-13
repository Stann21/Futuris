@extends('layouts.app')

@section('content')

    <div class="body-container col-12">

        <h1 class="text-left kop-text">Feedback Detail</h1>
        <hr>


        @foreach($feedback as $comments)

            <div class="row feedback-page">
                <i class="far fa-thumbs-up"></i>
                <p class="col-9">{{ $comments->feedback_description }}</p>

                <span class="label">{{App\feedback::FeedbackTag($comments->feedback_id)}}</span>
            </div>
        @endforeach
    </div>
@endsection

