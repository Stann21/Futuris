@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Achievement aanpassen
        @endslot
        @slot('link')
            /admin/user/{{$userid}}
        @endslot
        @slot('linktext')
        <div class="btn-back">  Terug</div>
        @endslot
    @endcomponent

    {{ Form::open(array('action' => ['AchievementUserController@update', $current_achievement->id], 'method' => 'put')) }}
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Kies achievement</h2>
            </div>
        </div><!-- End row -->
        <hr>


        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Achievement informatie</h2>
                </div>
            </div><!-- End row -->
            <hr>

            <div class="row">
                <div class="col-sm-12"><p>Elke achievmeent heeft wat meer informatie nodig zoals een titel, bsechrijving en de achievement is afgerond of niet.</p></div>
                <div class="col-sm-12">
                    <div class="form-group">
                        {{Form::label('title_achievement', 'Titel')}}
                        {{Form::text('title_achievement', $current_achievement->achievement_title, ['class' => 'form-control', 'placeholder' => 'Titel achievement'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('description_achievement', 'Beschrijving')}}
                        {{Form::text('description_achievement', $current_achievement->achievement_description, ['class' => 'form-control', 'placeholder' => 'Beschrijving achievement'])}}
                    </div>
                </div>
            </div> <!-- End row -->
        </div> <!-- end container -->

        <div class="row">
            <div class="col-sm-12"><p>Elke achievement heeft een afbeelding. Kies een van de volgende afbeeldingen om de achievement een afbeelding te geven. Om meer afbeeldingen toe te voegen <a href="/admin/achievement">klik hier.</a></p></div>
            @foreach ($achievements as $achievement)
                <div class="col-sm-4">
                @if ($current_achievement->achievement_img == $achievement->achievements_img)
                        <p>{{$achievement->achievements_title}} {{Form::radio('achievement', $achievement->id, true,array('class'=>'iconSelectedTrue'))}}</p>
                    @else
                        <p>{{$achievement->achievements_title}} {{Form::radio('achievement', $achievement->id, false,array('class'=>'iconSelectedTrue'))}}</p>
                @endif
                    <p><img src="/app/public/images/{{$achievement->achievements_img}}" class="medal"/></p>
                    <p>{{$achievement->achievements_description}}</p>
                </div>
            @endforeach
        </div><!-- End row  -->
    </div><!-- End container -->

    <!-- hidden stuff -->
    {{Form::hidden('userid', $userid)}}

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{Form::close() }}

@endsection