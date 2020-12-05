@extends('layouts.dashboard')

@section('title')
    {{ trans('texts.dashboard.offers.create.page-title') }}
@endsection

@section('dashboard-content')
    <x-grid.dashboard.main>
        <x-texts.h1>{{ trans('texts.dashboard.offers.create.title') }}</x-texts.h1>

        <x-forms.offers.create-offer-form />
    </x-grid.dashboard.main>
@endsection
