@extends('layouts.app')

@section('content')

    <div class="body-container achievement-page">
        <h1 class="text-left kop-text">Mijn Achievements</h1>
        <hr>
        <div class="row justify-content-start">
                @foreach($achievements as $achievement) 
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <a class="d-flex justify-content-center" href="achievementDetail/{{$achievement->id}}">
                    <div class="box-img">
                        <img class="img" src="/app/public/images/{{$achievement->achievement_img}}">
                    </div>
                </a>
                <p>{{$achievement->achievement_title}}</p>
            </div>
            @endforeach 
            </div>

        </div>
</div>
@endsection