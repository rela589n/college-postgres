@extends('layouts.dashboard-freelancer')

@php
/**
 * @var \App\Entities\Proposal\Proposal $proposal
 */
@endphp

@section('title')
    {{ trans('texts.dashboard.offers.edit.page-title') }}
@endsection

@section('dashboard-content')
    <x-grid.dashboard.main>
        <x-texts.h1>{{ trans('texts.dashboard.proposals.update-form.title', ['jobName' => $proposal->getJob()->getTitle()]) }}</x-texts.h1>

        <x-forms.offers.edit-proposal-form :proposal="$proposal"/>
    </x-grid.dashboard.main>
@endsection
