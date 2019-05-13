@extends('layouts.backend')

@section('content')
    @component('backendpages.partials.titleWithLink')
        @slot('title')
            Iconen
        @endslot
        @slot('link')
            /admin/icon/create
        @endslot
        @slot('linktext')
        <div class="btn-back"> Icoon toevoegen</div>
        @endslot
    @endcomponent

<div class="wrapperIcons">
    <div class="row">
        @foreach ($icons as $icon)
            <div class="col-sm-2">
                <p>{{$icon->icon_name}}</p>
                <i class="fas">&#x{{$icon->icon_code}};</i>

                {{Form::open(array('action' => ['IconController@destroy', $icon->icon_id], 'method' => 'delete')) }}
                {{Form::submit('Verwijderen', ['class' => 'btn btn-danger'])}}
                {{Form::close() }}
            </div>
        @endforeach
    </div>
</div> <!-- End row -->
@endsection