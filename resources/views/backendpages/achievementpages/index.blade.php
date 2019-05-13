@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Achievements template
        @endslot
        @slot('link')
            /admin/achievement/create
        @endslot
        @slot('linktext')
        <div class="btn-back">  Achievement template toevoegen</div>
        @endslot
    @endcomponent

    @if(count($achievements) > 0)
        <div class="row">
            @foreach($achievements as $achievement)
                <div class="col-sm-12 col-md-6 col-lg-4 userbox">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-12">
                            <div class="achievement">
                                <h4>{{$achievement->achievements_title}} <a href="/admin/achievement/{{$achievement->id}}/edit" class="achievementLink"><i class="fas fa-edit"></i></a></h4>
                                <p>Beschrijving:{{$achievement->achievements_description}}</p>
                                <p><img src="/app/public/images/{{$achievement->achievements_img}}"></p>
                            </div>
                        </div>
                    </div> <!-- End row -->
                </div>
             @endforeach 
             @else
                <p>Momenteel heb je geen achievements.</p>
        </div> <!-- End row -->
    @endif
@endsection