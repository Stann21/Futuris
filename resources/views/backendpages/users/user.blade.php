@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            {{$users->username}}
        @endslot
        @slot('link')
            /admin/user
        @endslot
        @slot('linktext')
        <div class="btn-back">   Terug</div>
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-sm-6">
            <div class="col-sm-12">
                <h2>Algemeen</h2>
                <div class="btn-back">  <a href="/admin/user/{{$users->id}}/edit">Aanpassen</a></div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        Balk
                    </div>
                    <div class="col-sm-6">
                        <p>Naam: {{$users->username}}</p>
                        <p>Code: {{$users->user_activationcode}}</p>
                        <p>Einddoel: {{$users->user_endgoal}}</p>
                        <p>Begonnen op: {{$users->created_at}}</p>
                    </div>
                </div> <!-- end row -->
            </div>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-12">
                <h2>Leerdoelen</h2>
                <div class="btn-back"> <a href="/admin/goals/create/{{$users->id}}/0/0">Maak een leerdoel aan</a></div>
                <hr>
                <div class="row">
                    {!! App\learning_goals::GoalsOverviewMentor($userid) !!}
                </div> <!-- End row -->
            </div>
        </div> <!-- end row -->
        <div class="col-sm-12">
            <h2>Achievements</h2>
            <div class="btn-back">   <a href="/admin/achievement/user/create/{{$userid}}/0/{{$userid}}">Geef gebruiker een achievement</a></div>
            <hr>
            <!-- foreach for prizes -->
            <div class="row">
                @foreach ($achievements as $achievement)
                    <div class="col-sm-3">
                        <div class="usersAchievement">
                            <h4>{{$achievement->achievement_title}}</h4>
                            <p>Beschrijving: {{$achievement->achievement_description}}</p>
                            <p class="text-center"><img class="medal" src="/app/public/images/{{$achievement->achievement_img}}"></p>
                            <p><a href="/admin/achievement/user/{{$achievement->id}}/edit/{{$users->id}}">Pas achievement aan</a></p>
                            {{Form::open(array('action' => ['AchievementUserController@destroys', $achievement->id, $users->id], 'method' => 'delete', 'class'=>'delete')) }}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {{Form::close() }}
                        </div>
                    </div>
                @endforeach
                <div class="col-sm-12">
                    <div class="btn-back"><a href="/admin/achievement/user/{{$users->id}}">Zie alle achievements</a></div>
                </div>
            </div><!-- end row -->
        </div>

        <div class="col-sm-12">
            <h2>Feedback</h2>
            <p> <div class="btn-back"><a href="/admin/feedback/create/{{$users->id}}/0/0">Geef algemene feedback</a></div></p>
            <hr>
            <div class="row">
                <div class="col-sm-2 titleBackendHomepage">Datum</div>
                <div class="col-sm-6 titleBackendHomepage">Feedback</div>
                <div class="col-sm-2 titleBackendHomepage">Soort feedback</div>
                <div class="col-sm-1"></div>
                <div class="col-sm-1"></div>
            </div><!-- End row -->

            <div class="row">
                @foreach($feedback as $feedbacks)
                    <div class="col-sm-2">{{ \Carbon\Carbon::parse($feedbacks->feedback_date)->format('d-m-Y')}}</div>
                    <div class="col-sm-6 feedbackBox">{{$feedbacks->feedback_description}}</div>
                    @switch($feedbacks->feedback_role)
                        @case ('0')
                            <div class="col-sm-2">Algemeen</div>
                            @break
                        @case ('1')
                            <div class="col-sm-2 ">Leerdoel</div>
                            @break
                        @case ('2')
                            <div class="col-sm-2">Achievement</div>
                            @break
                    @endswitch
                    <div class="col-sm-1">
                        <div class="btn-back"><a href="/admin/feedback/{{$feedbacks->feedback_id}}/edit/1">Aanpassen</a></div>
                   
                        {{Form::open(array('action' => ['FeedbackController@destroypages', $feedbacks->feedback_id, '1'], 'method' => 'delete', 'class'=>'delete')) }}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {{Form::close() }}
                    </div>
                @endforeach
            </div><!-- End row -->
        </div>
    </div>
    </div> <!-- End row -->

    <!-- Delete confirm -->
    <script>
        $(".delete").on("submit", function(){
            return confirm("Weet je zeker dat je het volgende wilt verwijderen?");
        });
    </script>
    <!-- End delete confirm -->
@endsection