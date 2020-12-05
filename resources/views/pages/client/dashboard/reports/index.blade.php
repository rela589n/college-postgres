@extends('layouts.dashboard')

@php
    /**
     * @var \App\Models\File[] $files
     */
@endphp

@section('title')
    {{ trans('texts.dashboard.file-reports.index.page-title') }}
@endsection

@section('dashboard-content')
    <x-grid.dashboard.main>
        <x-texts.h1 class="text-center">{{ trans('texts.dashboard.file-reports.index.title') }}</x-texts.h1>

        <x-texts.h3>
            {{ trans('texts.dashboard.file-reports.index.files-count') }}: {{ $currentFilesCount }}
        </x-texts.h3>
        <x-texts.h3>
            {{ trans('texts.dashboard.file-reports.index.deleted-files-count') }}: {{ $deletedFilesCount }}
        </x-texts.h3>

        <x-entities.reports.table :files="$files"
                                  :disposableUsedLinksCount="$summaryUsedDisposableLinksCount"
                                  :disposableLinksCount="$summaryDisposableLinksCount"
                                  :unlimitedViewsSum="$summaryUnlimitedLinksViews"
                                  :totalViewsCount="$totalViewsFullCount"
        />
    </x-grid.dashboard.main>
@endsection
