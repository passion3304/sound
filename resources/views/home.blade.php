@extends('layouts.three_col')

@section('right')
    @include('modules.category.sidebar')
@endsection

@section('left')
    @include('modules.blog.sidebar')
@endsection

@section('middle')
    <div class="panel" id="midCol">
        <div class="panel-heading middle-col-heading" >{{ trans('word.latest_tracks') }}</div>
        <div class="panel-body">

            @foreach($tracks as $track)
                <h5><a href="{{ action('TrackController@show',$track->id) }}"><i
                                class="fa fa-music"></i> {{ $track->name }}</a></h5>
            @endforeach
        </div>
    </div>
@endsection
