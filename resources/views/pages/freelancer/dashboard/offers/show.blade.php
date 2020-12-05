@extends('layouts.dashboard-freelancer')

@php
    /**
     * @var \App\Entities\Job\Job $job
     */
@endphp

@section('title')
    {{ trans('texts.dashboard.offers.show.page-title') }} - {{$job->getTitle()}}
@endsection

@section('dashboard-content')
    <x-grid.dashboard.main>
        <x-texts.h1 class="text-center">
            {{ trans('texts.dashboard.offers.show.title') }}
        </x-texts.h1>

        <div class="row">
            <div class="col-3">
                <h2>{{ trans('texts.dashboard.offers.show.name') }}:</h2>
            </div>
            <div class="col-9">
                <p class="h3">{{ $job->getTitle() }}</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-3">
                <h2>{{ trans('texts.dashboard.offers.show.description') }}:</h2>
            </div>
            <div class="col-9">
                <p class="h4">{{ $job->getDescription() }}</p>
            </div>
        </div>
        <x-texts.h2 class="mt-5">
            {{ trans('texts.dashboard.offers.show.proposals-list') }}
        </x-texts.h2>

        <x-proposals.list-for-f :proposals="$job->getProposals()">

        </x-proposals.list-for-f>

        @if ($authUser->can('fCreate', [\App\Entities\Proposal\Proposal::class, $job]))
            <x-buttons.link.action.main class="btn-primary" :href="route('freelancer.dashboard.proposals.create', $job->getId())">
                {{ trans('texts.dashboard.proposals.create') }}
            </x-buttons.link.action.main>
        @endif

    </x-grid.dashboard.main>
@endsection
