@extends('layouts.root.generic')

@section('head-styles')
    @parent
    <link href="{{ asset('libs/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection

@section('content')
    <x-sidebars.dashboard/>
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            @yield('dashboard-content')
        </div>
    </div>
@endsection

@section('bottom-scripts')
    @parent
    <x-scripts.bootstrap-bundle/>
    <x-scripts.jquery-slimscroll/>
    <script src="{{ asset('js/dashboard/main-js.js') }}"></script>
@endsection
