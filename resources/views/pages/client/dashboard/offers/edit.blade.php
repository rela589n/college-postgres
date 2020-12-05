@extends('layouts.dashboard')

@php
    /**
     * @var \App\Entities\Job\Job $job
     */
@endphp

@section('title')
    {{ trans('texts.dashboard.offers.edit.page-title') }} - {{ $job->getTitle() }}
@endsection

@section('dashboard-content')
    <x-grid.dashboard.main>
        <x-texts.h1>{{ trans('texts.dashboard.offers.edit.title') }}</x-texts.h1>

        <x-forms.offers.edit-offer-form :job="$job"/>
    </x-grid.dashboard.main>
@endsection
