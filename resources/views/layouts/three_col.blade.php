@extends('layouts.master')

@section('content')

    <div class="no-gutter row">
        <div class="col-md-12">
            @yield('banner')
        </div>
    </div>

    <div class="container">
        <div class="no-gutter row">
            @yield('breadcrumb')
        </div>
    </div>

    <div class="no-gutter row">

        <div class="col-md-3">
            @yield('right')
        </div>

        <div class="col-md-4">
            @yield('middle')
        </div>

        <div class="col-md-5" id="content">
            @yield('left')
        </div>

    </div>

@endsection
