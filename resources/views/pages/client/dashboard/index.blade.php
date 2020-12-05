@extends('layouts.dashboard')

@section('title')
    {{ trans('texts.dashboard.index.page-title') }}
@endsection

@section('dashboard-content')
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h2 class="text-center">{{ trans('texts.dashboard.index.header') }}</h2>
            </div>
        </div>
    </div>
@endsection
