@extends('layouts.dashboard')

@php
    /**
      * @var \App\Models\File $file
      */
@endphp

@section('title')
    {{ $file->description->publicName() }} - {{ trans('texts.dashboard.file-links.create.page-title') }}
@endsection

@section('dashboard-content')
    <x-grid.dashboard.main>
        <x-texts.h1>{{ trans('texts.dashboard.file-links.create-form.title') }}</x-texts.h1>

        <x-forms.links.create-link-to-file :file="$file"/>
    </x-grid.dashboard.main>
@endsection
