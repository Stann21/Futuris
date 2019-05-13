@extends('layouts.app')

@section('content')

    <div class="body-container col-12">

        <h1 class="text-left kop-text">Hoofddoelen</h1>
        <hr>

        <div id="carousel" class="container text-center">
            <div class="carousel slide w-100">
                <div class="carousel-inner w-100 mx-auto" role="listbox">
                    <div class="carousel-item row active">
                        @foreach($goals->take(6) as $goal)
                            <div class="col-2 float-left maingoal margin-maingoal text-muted">
                                <div class="maingoal-barcontent">
                                    <div class="vertical-align">
                                        <div>
                                            <i class="fas">&#x{{$goal->learning_icon}};</i>
                                            <p>{{$goal->learning_name}}</p>
                                            <p>{{$percentageCounter[$i]['0']}} / {{$percentageCounter[$i]['1']}}</p>
                                        </div>
                                    </div>
                                    <div class="goalbutton">
                                        <a href="/goal/{{$goal->learning_id}}"><i class="fa fa-chevron-down"></i></a>
                                    </div>
                                </div>

                                <div id="{{$goal->learning_id}}" class="overlay"></div>
                            </div>
                            @php($i++)
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div id="carouselMobile" class="container text-center">
            <div id="recipeCarousel" class="carousel slide w-100" data-interval="false" data-ride="carousel">
                <div class="carousel-inner w-100 mx-auto" role="listbox">
                    <div class="carousel-item row active">

                        @foreach($goals as $goal)
                            @if ($loop->iteration <= 3)
                                <div class="col-3 float-left maingoal margin-maingoal text-muted">
                                    <div class="maingoal-barcontent">
                                        <div class="vertical-align">
                                            <div>
                                                <i class="fas">&#x{{$goal->learning_icon}};</i>
                                                <p>{{$goal->learning_name}}</p>
                                            </div>
                                        </div>
                                        <div class="goalbutton">
                                            <a href="/goal/{{$goal->learning_id}}"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                    </div>

                                    <div class="overlay"></div>
                                </div>
                            @endif
                        @endforeach


                    </div><!-- End couresel item -->

                    <div class="carousel-item row">

                        @foreach($goals as $goal)
                            @if($loop->iteration > 3)
                                @if ($loop->iteration > 6)

                                    @else
                                    <div class="col-3 float-left maingoal margin-maingoal text-muted">

                                        <div class="maingoal-barcontent">
                                            <div class="vertical-align">
                                                <div>
                                                    <i class="fas">&#x{{$goal->learning_icon}};</i>
                                                    <p>{{$goal->learning_name}}</p>
                                                </div>
                                            </div>
                                            <div class="goalbutton">
                                                <a href="/goal/{{$goal->learning_id}}"><i class="fa fa-chevron-down"></i></a>
                                            </div>
                                        </div>

                                        <div class="overlay"></div>
                                    </div>
                                @endif
                            @endif
                        @endforeach

                    </div>
                </div>


                <!-- carousel control -->
                <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
                </a>
                <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                </a>
                <!-- End carousel control -->

            </div> <!-- End carousel-inner -->
        </div> <!-- End recipeCarousel -->




        <div class="row">
            <div class="overview-col-left col-lg-6 col-md-12 col-sm-12 col-12 ">
                <h2 class="text-left kop-text">Feedback</h2>
                <hr>

                @foreach($feedback as $comments)
                    @if ($loop->last)
                        <div  class="row feedback">
                            <div class="col-12 d-flex justify-content-between">
                                <i class="far fa-thumbs-up col-1"></i>
                                <span class="labeloverview offset-6">{{App\feedback::FeedbackTag($comments->feedback_id)}}</span>
                            </div>
                            <p class="col-12 margin-feedback-thumb">{{ substr($comments->feedback_description, 0, 150) }}{{ strlen
                            ($comments->feedback_description) > 150 ? "..." : "" }}</p>

                            @if ( (strlen($comments->feedback_description)) > 150 )
                                <a href="/feedbackDetail/{{$comments->feedback_id}}" class="readmore-overview">Lees meer <i class="fas fa-angle-right"></i></a>
                            @endif

                        </div>
                    @endif
                @endforeach

                <a href="feedback" class="button">Bekijk alle feedback <i class="fas fa-chevron-right"></i></a>

            </div>

            <div class="overview-col-right col-lg-6 col-md-12 col-sm-12 col-12 achievements">
                <h2 class="text-left kop-text">Laatst verdiende achievements</h2>
                <hr>
                <div class="row text-center">
                    @foreach($achievements->take(-3) as $achievement)

                    <div class="col-4">
                        <a  href="achievementDetail/{{$achievement->id}}">
                            <div class="box-img d-flex justify-content-center">
                                <img class="img" src="/app/public/images/{{$achievement->achievement_img}}">
                            </div>
                        </a>
                        <p>{{$achievement->achievement_title}}</p>
                    </div>
                    @endforeach
                </div>

                <a href="achievements" class="button">Bekijk alle achievements <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>

    </div>
@endsection

