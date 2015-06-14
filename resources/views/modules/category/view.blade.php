@extends('layouts.three_col')

@section('title')
    {{ $category->name }}
@endsection

@section('breadcrumb')
    <div id="bc1" class="btn-group btn-breadcrumb pBottom20">
        <a href="{{url('home')}}" class="btn btn-default"><i class="fa fa-home"></i>&nbsp; </a>
        <a href="{{action('CategoryController@show',$category->id)}}" class="btn btn-default "><i
                    class="fa fa-folder"></i> {{ $category->name }}</a>
    </div>
@endsection

@section('style')
    @parent
    <link href="/bower_components/jquery-ui/themes/hot-sneaks/jquery-ui.min.css" rel="stylesheet">
    <link href="/css/jplayer.css" rel="stylesheet">
@endsection

@section('script')
    @parent
@endsection

@section('middle')
    @include('modules.album.sidebar',['record'=>$category])
@endsection

@section('right')
    @include('modules.category.sidebar')
@endsection

@section('left')
    @include('modules.track.sidebar',['record'=>$category])
@endsection