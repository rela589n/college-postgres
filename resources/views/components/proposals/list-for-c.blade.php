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
                    <div class="card-title">
                        {{ $proposal->getFreelancer()->getEmail() }}
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted">
                        {{ $proposal->getFreelancer()->getHourRate()->formatInUsd() }}
                    </h6>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ $proposal->getCoverLetter() }}</p>
                        <footer class="blockquote-footer">
                            Estimate: {{ $proposal->getEstimatedTime()->formatInHours() }}</footer>
                    </blockquote>

                    @if ($authUser->can('cAccept', $proposal))
                        <form method="post"
                              action="{{ route('customer.dashboard.offers.accept', ['offer' => $proposal->getJob()->getId()]) }}">
                            @csrf
                            <input type="hidden" name="proposal_id" value="{{ $proposal->getUuid() }}">
                            <button type="submit" class="btn btn-xs btn-secondary"
                                    style="position: absolute; top: .8rem; right: 2rem; color: white;">
                                Accept
                            </button>
                        </form>
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
