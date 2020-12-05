@extends('layouts.dashboard-freelancer')

@php
/**
 * @var \App\Entities\Job\Job $job
 */
@endphp

@section('title')
    {{ trans('texts.dashboard.offers.create.page-title') }}
@endsection

@section('dashboard-content')
    <x-grid.dashboard.main>
        <x-texts.h1>{{ trans('texts.dashboard.proposals.create-form.title', ['jobName' => $job->getTitle()]) }}</x-texts.h1>

        <x-forms.offers.create-proposal-form :job="$job"/>
    </x-grid.dashboard.main>
@endsection
