@extends('layouts.dashboard-freelancer')

@php
    /**
     * @var \App\Entities\Job\Job[] $offers
     */
@endphp

@section('title')
    {{ trans('texts.dashboard.offers.index.page-title-freelancer') }}
@endsection

@section('dashboard-content')
    <x-grid.dashboard.main>
        <x-texts.h1>{{ trans('texts.dashboard.offers.index.title') }}</x-texts.h1>
        <x-entities.offers.table-for-freelancers :jobs="$offers"/>
        <form method="GET">
            <div class="my-4 d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <input type="text" name="filters[title]" value="{{ request('filters.title') }}">
                    <label class="mt-2">DESC <input type="checkbox" name="desc[title]"
                                       @if(request('desc.title')) checked="checked" @endif></label>
                </div>
                <div class="d-flex flex-column">
                    <input type="text" name="filters[description]" value="{{ request('filters.description') }}">
                    <label class="mt-2">DESC <input type="checkbox" name="desc[description]"
                                       @if(request('desc.description')) checked="checked" @endif></label>
                </div>
                <div>
                    <input type="submit" value="Filter">
                </div>
            </div>
        </form>
    </x-grid.dashboard.main>
@endsection
