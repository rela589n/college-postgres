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
                <div class="d-flex">
                    <div>
                        <x-buttons.link.action.view :href="route('freelancer.dashboard.offers.show', $job->getId())">
                            {{ trans('texts.dashboard.offers.table.buttons.view') }}
                        </x-buttons.link.action.view>
                    </div>
                    <div class="ml-2">
                        <form method="post"
                              action="{{ route('freelancer.dashboard.offers.finish', ['offer' => $job->getId()]) }}">
                            @csrf
                            <button type="submit" class="btn btn-xs btn-secondary">
                                Finish
                            </button>
                        </form>
                    </div>
                </div>



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
