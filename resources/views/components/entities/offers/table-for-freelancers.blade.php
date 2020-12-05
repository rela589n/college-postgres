@php
    /**
    * @var \App\Entities\Job\Job[] $jobs
    */
@endphp
<table class="table ">
    <thead>
    <tr>
        <th scope="col">{{ trans('texts.dashboard.offers.table.name') }}</th>
        <th scope="col">{{ trans('texts.dashboard.offers.table.description') }}</th>
        <th scope="col">{{ trans('texts.dashboard.offers.table.actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($jobs as $job)
        <tr>
            <td>{{ $job->getTitle() }}</td>
            <td><p>{{ \Illuminate\Support\Str::limit($job->getDescription())  }}</p></td>
            <td>
                <x-buttons.link.action.view :href="route('freelancer.dashboard.offers.show', $job->getId())">
                    {{ trans('texts.dashboard.offers.table.buttons.view') }}
                </x-buttons.link.action.view>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">
                {{ trans('texts.dashboard.offers.table.empty-freelancer') }}
            </td>
        </tr>
    @endforelse
</table>
