@extends('layouts.dashboard')

@php
    /**
     * @var \App\Models\FileLinkToken[] $linkTokens
     * @var \App\Models\File $file
    */
@endphp

@section('title')
    {{ $file->description->publicName() }} - {{ trans('texts.dashboard.file-links.of-file.page-title') }}
@endsection

@section('dashboard-content')
    <x-grid.dashboard.main>
        <x-texts.h1>{{ trans('texts.dashboard.file-links.title') }}:</x-texts.h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ trans('texts.dashboard.file-links.table.link-url') }}</th>
                <th scope="col">{{ trans('texts.dashboard.file-links.table.type') }}</th>
                <th scope="col">{{ trans('texts.dashboard.file-links.table.status') }}</th>
                <th scope="col">{{ trans('texts.dashboard.file-links.table.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($linkTokens as $linkToken)
                <tr>
                    <td><p>{{ $linkToken->link() }}</p></td>
                    <td><p>{{ $linkToken->typeReadable() }}</p></td>
                    <td><p>{{ $linkToken->statusReadable() }}</p></td>
                    <td>
                        <x-buttons.link.action.delete :href="route('dashboard.links.destroy', [
                                                                'file' => $file,
                                                                'link' => $linkToken
                                                            ])"
                                                      :sendForm="'#' . 'delete-token-' . $linkToken->id">
                            {{ trans('texts.dashboard.file-links.buttons.delete') }}
                        </x-buttons.link.action.delete>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3"><p>{{ trans('texts.dashboard.file-links.list-empty') }}</p></td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <x-buttons.link.main class="mt-4"
                             href="{{ route('dashboard.links.create', $file) }}">
            {{ trans('texts.dashboard.file-links.create-new-btn') }}
        </x-buttons.link.main>
    </x-grid.dashboard.main>

    @foreach($linkTokens as $linkToken)
        <x-forms.common.delete :action="route('dashboard.links.destroy', [
                                            'file' => $file,
                                            'link' => $linkToken
                                        ])"
                               :id="'delete-token-' . $linkToken->id"/>
    @endforeach
@endsection
