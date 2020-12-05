@extends('layouts.dashboard')

@php
    /**
     * @var \App\Entities\Job\Job[] $offers
     */
@endphp

@section('title')
    {{ trans('texts.dashboard.offers.index.page-title') }}
@endsection

@section('dashboard-content')
    <x-grid.dashboard.main>
        <x-texts.h1>{{ trans('texts.dashboard.offers.index.title') }}</x-texts.h1>
        <x-entities.offers.table :jobs="$offers"/>

        <x-buttons.link.main :href="route('customer.dashboard.offers.create')">
            {{ trans('texts.dashboard.offers.index.add-new') }}
        </x-buttons.link.main>
    </x-grid.dashboard.main>
@endsection
