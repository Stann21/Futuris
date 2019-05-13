@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.title')
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

<div class="wrapperBackendHomepage">
    <div class="row">
        <div class="col-sm-2">
            <p class="titleBackendHomepage">Datum</p>
        </div>
        <div class="col-sm-2">
            <p class="titleBackendHomepage">Naam</p>
        </div>
        <div class="col-sm-8">
            <p class="titleBackendHomepage">Feedback</p>
        </div>
    </div> <!-- End row -->
    <div class="row">
        @foreach($feedback as $feedbackOne)
            @foreach ($usersClient as $user)
                @if ($feedbackOne->feedback_client == $user->id)
                    <div class="col-sm-2">
                      <p class="subBackendHomepage"> {{ \Carbon\Carbon::parse($feedbackOne->feedback_date)->format('d-m-Y')}}</p>
                    </div>
                    <div class="col-sm-2">
                        {{$user->username}}
                    </div>
                    <div class="col-sm-8">
                        {{$feedbackOne->feedback_description }}
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
</div><!-- End row -->
@endsection
