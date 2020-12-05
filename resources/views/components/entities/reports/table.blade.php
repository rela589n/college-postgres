@php
    /**
     * @var \App\Models\File[] $files
     */
@endphp
<table class="table">
    <thead>
    <tr>
        <th scope="col">{{ trans('texts.dashboard.file-reports.table.name') }}</th>
        <th scope="col">{{ trans('texts.dashboard.file-reports.table.disposable-links-used') }}</th>
        <th scope="col">{{ trans('texts.dashboard.file-reports.table.unlimited-links-views') }}</th>
        <th scope="col">{{ trans('texts.dashboard.file-reports.table.views-count') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($files as $file)
        <tr>
            <td>{{ $file->description->publicName() }}</td>
            <td>
                <p>{{ $file->disposable_links_used_count }} / {{ $file->disposable_links_count }}</p>
            </td>
            <td>{{ $file->unlimited_link_views_count }}</td>
            <td>{{ $file->views_count }}</td>
        </tr>
        @if($loop->last)
            <th scope="row">
                {{ trans('texts.dashboard.file-reports.table.summary') }}:
            </th>
            <td>
                <p>{{ $disposableUsedLinksCount }} / {{ $disposableLinksCount }}</p>
            </td>
            <td>
                {{ $unlimitedViewsSum }}
            </td>
            <td>
                {{ $totalViewsCount }}
            </td>
        @endif
    @empty
        <tr>
            <td colspan="4">
                {{ trans('texts.dashboard.file-reports.table.empty') }}
            </td>
        </tr>
    @endforelse
</table>
