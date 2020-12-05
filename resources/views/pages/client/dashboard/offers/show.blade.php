@extends('layouts.dashboard')

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
            @if($authUser->can('cEdit', $job))
                <x-buttons.link.main class="ml-4"
                                     href="{{ route('customer.dashboard.offers.edit', $job->getId()) }}">{{ trans('texts.dashboard.offers.show.edit-btn') }}
                </x-buttons.link.main>
            @endif
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

        <x-proposals.list-for-c :proposals="$job->getProposals()">

        </x-proposals.list-for-c>
    </x-grid.dashboard.main>
@endsection
