@extends('layouts.app')

@section('content')
    <div class="body-container col-lg-8 col-md-10 col-12 offset-lg-2 offset-md-1">

        @foreach($achievements as $achievement)

            <div class="achievements row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="box-img2">
                        <img class="img" src="/app/public/images/{{$achievement->achievement_img}}">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-12">
                    <h2 class="text-left kop-text h2-style">{{$achievement->achievement_title}}</h2>

                </div>
            </div>

  
            <div class="col-12">
                <h2 class="text-left kop-text">Feedback</h2>
                <hr>
                

                <div class="row justify-content-center margin-subgoal">
                    <div class="col-lg-1 col-md-2 col-sm-3 col-3">
                        <div class="goalbutton-sub">
                            <span><i class="fas fa-comments"></i></span>
                        </div>
                    </div>
                 
                    <div class="col-lg-9 col-md-8 col-sm-9 col-9 offset-lg-1 offset-md-1 subgoal">
                     
                        <p>{{$achievement->achievement_description}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
         


    </div>
@endsection