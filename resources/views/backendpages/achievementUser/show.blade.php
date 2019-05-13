@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Achievements van {{$user->username}}
        @endslot
        @slot('link')
            /admin/user/{{$user->id}}
        @endslot
        @slot('linktext')
        <div class="btn-back"> Terug</div>
        @endslot
    @endcomponent

    <!-- foreach for achievements -->
    <div class="row">
        @foreach ($achievements as $achievement)
            <div class="col-sm-3">
                <div class="achievement">
                    <h4>{{$achievement->achievement_title}}</h4>
                    <p>Beschrijving: {{$achievement->achievement_description}}</p>
                    <p class="text-center"><img class="medal" src="/app/public/images/{{$achievement->achievement_img}}"></p>
                    <div class="col-sm-6">
                        <p><a href="/admin/achievement/user/{{$achievement->id}}/edit/{{$user->id}}">Aanpassen</a></p>
                    </div>
                    <div class="col-sm-6">
                        {{Form::open(array('action' => ['AchievementUserController@destroys', $achievement->id, $user->id], 'method' => 'delete', 'class'=>'delete')) }}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {{Form::close() }}
                    </div>
                </div>
            </div>
    @endforeach

    <!-- Delete confirm -->
        <script>
            $(".delete").on("submit", function(){
                return confirm("Weet je zeker dat je het volgende wilt verwijderen?");
            });
        </script>
    <!-- End delete confirm -->
    </div> <!-- End row -->
@endsection