@extends('layouts.app')

@section('content')

    <div class="body-container col-12">

        <h1 class="text-left kop-text">Feedback</h1>
        <hr>


        @foreach($feedback as $comments)

            <div class="margin-feedback">
                <div class="row feedback-page">
                    <i class="far fa-thumbs-up"></i>
                    <p class="col-lg-8 col-md-8 col-sm-12 col-12">{{ substr($comments->feedback_description, 0, 200) }}{{ strlen
                            ($comments->feedback_description) > 200 ? "..." : "" }}</p>

                    <span class="label">{{App\feedback::FeedbackTag($comments->feedback_id)}}</span>
                </div>

                @if ( (strlen($comments->feedback_description)) > 200 )
                    <a href="/feedbackDetail/{{$comments->feedback_id}}" class="readmore">Lees meer <i class="fas fa-angle-right"></i></a>
                @endif
            </div>

        @endforeach



    </div>
@endsection

