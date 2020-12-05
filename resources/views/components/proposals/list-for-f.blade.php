@props(['proposals'])
@php
    /**
     * @var \App\Entities\Proposal\Proposal[] $proposals
     */
@endphp
<ul>
    @forelse($proposals as $proposal)
        <li>
            <div class="card">
                <div class="card-header">
                    {{ $proposal->getFreelancer()->getEmail() }}
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ $proposal->getCoverLetter() }}</p>
                        <footer class="blockquote-footer">
                            Estimate: {{ $proposal->getEstimatedTime()->formatInHours() }}</footer>
                    </blockquote>

                    @if($authUser->can('fEdit', $proposal))
                        <x-buttons.link.action.edit
                            :href="route('freelancer.dashboard.proposals.edit', ['offer' => $proposal->getJob()->getId(), 'proposal' => $proposal->getUuid()])"
                            style="position: absolute; top: .8rem; right: 2rem;">
                            Edit
                        </x-buttons.link.action.edit>
                    @endif
                    @if ($proposal->isAccepted())
                        <span class="badge badge-primary position-absolute" style="right: 1rem; top: 0.8rem">Accepted</span>
                    @endif
                </div>
            </div>
        </li>
    @empty
        <li>
            No freelancers applied on this job
        </li>
    @endforelse
</ul>
