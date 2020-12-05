@extends('layouts.dashboard')

@php
    /**
     * @var \App\Entities\Job\Job[] $offers
     */
@endphp

@section('title')
    {{ trans('texts.dashboard.offers.in-work.page-title') }}
@endsection

@section('dashboard-content')
    <x-grid.dashboard.main>
        <x-texts.h1>{{ trans('texts.dashboard.offers.in-work.title') }}</x-texts.h1>
        <x-entities.offers.table-in-work :jobs="$offers"/>
    </x-grid.dashboard.main>
@endsection
