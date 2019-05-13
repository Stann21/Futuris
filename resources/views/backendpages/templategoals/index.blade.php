@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Leerdoelen template
        @endslot
        @slot('link')
            /admin/goalstemplate/create/2/0
        @endslot
        @slot('linktext')
        <div class="btn-back">  Nieuwe template aanmaken</div>
        @endslot
    @endcomponent

    <div class="row">
        @foreach($templates as $template)
        <div class="col-sm-12 col-md-6 col-lg-4 userbox">
            <div class="row">
                <div class="wrapperSubdoelenAchievement">
                <div class="col-sm-6">
                    <div class="iconPersons">
                        <p><i class="fa">&#x{{$template->template_icon}};</i></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <a href="/admin/goalstemplate/{{$template->template_id}}">{{$template->template_name}}</a>
                    <p>Subdoelen: {{App\template_goals::CountTemplateGoals($template->template_id)}}</p>
                    <p>Eindigt de template? {{App\template_goals::TemplateEnd($template->template_id)}}</p>
                </div>
                </div>
            </div> <!-- End row -->
        </div>
        @endforeach
    </div><!-- End row -->
@endsection