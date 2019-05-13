@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Mijn deelnemers
        @endslot
        @slot('link')
            /admin/user/create/0
        @endslot
        @slot('linktext')
        <div class="btn-back">     Deelnemer toevoegen</div>
        @endslot
    @endcomponent

    @if(count($users) > 0)
        <div class="row">
            @foreach($users as $user)
                <article class="containerBackEndCliënten">
                    <div class="col-sm-12 col-md-6 col-lg-4 userbox">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="iconPersons">
                                 <i class="fas fa-user col-lg-5 mx-auto"></i>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="wrapperUserInfo">
                                <a href="/admin/user/{{$user->id}}">{{$user->username}}</a>
                                <p>Code: {{$user->user_activationcode}}</p>
                                <p>Behaald: {{$MaingoalsPercentage[$user->id]}}</p>
                                </div>

                            </div>
                        </div> <!-- End row -->
                            <div class="wrapperPrint">
                                <a href="/admin/form/{{$user->id}}"}}><i class="fas fa-print"></i></a>
                            </div>
                    </div>
                </article>
            @endforeach
    @else
        <p>Momenteel heb je geen clienten.</p>
    @endif
        </div> <!-- End row -->
@endsection