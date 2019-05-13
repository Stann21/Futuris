@extends('layouts.app')

@section('content')
    <div class="body-container">

        <!-- Top part -->
       <div class="row justify-content-between goal-title-container">
            <h1 class="text-left kop-text-goal col-md-8 col-12"><span><i class= "maingoal-icon fas">&#x{{$mainGoal->learning_icon}}</i></span></span>Leerdoelen {{$mainGoal->learning_name}}</h1>
            <p>@php($done = '0')
                @php($total = '0')
                @foreach ($goals as $goal)
              
                    @if ($goal->learning_finished == 0)
                        @php($total++)
                    @else
                        @php($done ++)
                        @php($total ++)
                    @endif
                @endforeach
            {{$done}} / {{$total}} behaald</p>
        </div>
        <hr class="col-11 col-sm-12">
        <!-- End top part -->

        <!-- body part -->
        @foreach($goals as $goal)
            <div class="row justify-content-center margin-subgoal">
                <div class="col-lg-1 col-md-2 col-sm-2 col-2">
                    <div class="goalbutton-sub">
                        <!-- Normal icon of check -->
                        @if ($goal->learning_finished == 0)
                            <span><i class="fas">&#x{{$goal->learning_icon}}</i></span>
                        @else
                            <span><i class="fas fa-check"></i></span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-11 col-md-10 col-sm-10 col-9 subgoal">
                    <div class="subgoal-title"><p>{{$goal->learning_description}}</p></div>

                <div class="row">
                    <hr class="col-11">
                    @if($goal->learning_finished == '1')
                     <!-- Start form -->
                            <div class="col-lg-6 col-12">
                                <div class="row">
                                    <p class="question col-lg-6 col-12">Hoe vond je het gaan?</p>
                                    <div class="assignment col-lg-5 col-12">
                                        {{Form::open(array('action' => ['LearningGoalsController@insert',$mainGoal->learning_id], 'method' => 'post')) }}
                                        @switch($userid->user_feedback)
                                            @case(2)
                                                @if ($goal->learning_feedbackIcon == '5' || $goal->learning_feedbackIcon == '4' || $goal->learning_feedbackIcon == '3')
                                                    {{Form::radio('feedbackicon', '4', true)}}<i class="far fa-thumbs-up far-marging"></i>
                                                @else
                                                    {{Form::radio('feedbackicon', '4')}}<i class="far fa-thumbs-up far-marging"></i>
                                                @endif

                                                @if ($goal->learning_feedbackIcon == '2' || $goal->learning_feedbackIcon == '1')
                                                    {{Form::radio('feedbackicon', '2', true)}} <i class="far fa-thumbs-down"></i>
                                                @else
                                                    {{Form::radio('feedbackicon', '2')}} <i class="far fa-thumbs-down"></i>
                                                @endif
                                                @break

                                            @case(1)
                                                @if ($goal->learning_feedbackIcon == '5' || $goal->learning_feedbackIcon == '4')
                                                    {{Form::radio('feedbackicon', '5', true)}}<a href=""><i class="far fa-smile far-marging"></i></a>
                                                @else
                                                    {{Form::radio('feedbackicon', '5')}}<a href=""><i class="far fa-smile far-marging"></i></a>
                                                @endif

                                                @if ($goal->learning_feedbackIcon == '3')
                                                    {{Form::radio('feedbackicon', '3', true)}}<a href=""><i class="far fa-meh far-marging"></i></a>
                                                @else
                                                    {{Form::radio('feedbackicon', '3')}}<a href=""><i class="far fa-meh far-marging"></i></a>
                                                @endif

                                                @if ($goal->learning_feedbackIcon == '2' || $goal->learning_feedbackIcon == '1')
                                                    {{Form::radio('feedbackicon', '1', true)}}<a href=""><i class="far fa-frown"></i></a>
                                                @else
                                                    {{Form::radio('feedbackicon', '1')}}<a href=""><i class="far fa-frown"></i></a>
                                                @endif
                                                @break

                                            @case(3)
                                                {{Form::selectRange('feedbackicon', 1, 5, $goal->learning_feedbackIcon)}}
                                                @break
                                        @endswitch
                                    </div>
                                </div>

                                <div class="col-12">
                                    @if (!empty($goal->learning_feedback))
                                        {{Form::textarea('feedback', $goal->learning_feedback, ['class' => 'form-control', 'placeholder' => 'Type hier je reactie...'])}}
                                        @else
                                        {{Form::textarea('feedback', '', ['class' => 'form-control', 'placeholder' => 'Type hier je reactie...'])}}
                                    @endif
                                    {{Form::hidden('subgoalID', $goal->learning_id)}}
                                    {{Form::submit('Opslaan', ['class' => 'button'])}}
                                    {{Form::close() }}
                                </div>
                            </div> <!-- End row -->

                         <div class="col-md-6 col-12 d-flex justify-content-end">
                             @foreach ($achievement as $price)
                                 @if($price->achievement_subjectid == $goal->learning_id)
                                     <a class="subgoal-achievement" href="/achievementDetail/{{$price->id}}">
                                         <img src="/app/public/images/{{$price->achievement_img}}"/>
                                     </a>
                                 @endif
                             @endforeach
                         </div>
             <!--End form-->
                    @endif
                </div><!-- end row -->
                </div><!-- end subgoal -->
            </div> <!-- End row justift content -->
        @endforeach
        <!-- End body part -->

    </div> <!-- End body container -->
@endsection