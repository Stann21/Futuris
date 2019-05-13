@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Achievement toewijzen
        @endslot
        @slot('link')
            /admin/user/{{$userid}}
        @endslot
        @slot('linktext')
        <div class="btn-back"> Terug</div>
        @endslot
    @endcomponent
    {{ Form::open(array('action' => ['AchievementUserController@store'], 'method' => 'post')) }}
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Achievement informatie</h2>
            </div>
        </div><!-- End row -->
        <hr>

        <div class="row">
            <div class="col-sm-12"><p>Elke achievement heeft wat meer informatie nodig zoals een titel, bsechrijving en de achievement is afgerond of niet.</p></div>
            <div class="col-sm-12">
                <div class="containerIconEdit">
                    <div class="form-group">
                        {{Form::label('title_achievement', 'Titel')}}
                        {{Form::text('title_achievement', '', ['class' => 'form-control', 'placeholder' => 'Titel achievement'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('description_achievement', 'Beschrijving')}}
                        {{Form::text('description_achievement', '', ['class' => 'form-control', 'placeholder' => 'Beschrijving achievement'])}}
                    </div>
                </div>
            </div>
        </div> <!-- End row -->
    </div> <!-- end container -->

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Kies achievement</h2>
            </div>
        </div><!-- End row -->
        <hr>

        <div class="row">
                <div class="wrapperCreateAchievement">
            <div class="col-sm-12"><p>Elke achievement heeft een afbeelding. Kies een van de volgende afbeeldingen om de achievement een afbeelding te geven. Om meer afbeeldingen toe te voegen <a href="/admin/achievement">klik hier.</a></p></div>
            @foreach ($achievements as $achievement)
                <div class="col-sm-3">
                        <div class="containerIconEdit">
                    <p><img src="/app/public/images/{{$achievement->achievements_img}}" class="medal"/></p>
                    <p>{{$achievement->achievements_title}} {{Form::radio('achievement', $achievement->id,false ,array('class'=>'iconSelectedTrue'))}}</p>
                    <p>{{$achievement->achievements_description}}</p>
                </div>
                </div>
            @endforeach
        </div><!-- End row  -->
    </div><!-- End container -->

    <!-- hidden stuff -->
    {{Form::hidden('userid', $userid)}}
    {{Form::hidden('onwhat', $onwhat)}}
    {{Form::hidden('onwhatid', $onwhatid)}}

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{Form::close() }}

@endsection