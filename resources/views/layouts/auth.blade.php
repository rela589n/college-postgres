@extends('layouts.root.generic')

@section('body-class') @parent auth @endsection

@section('content')
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4 m-auto mtb-auto">
                @yield('auth-content')
            </div>
        </div>
    </div>
@endsection
