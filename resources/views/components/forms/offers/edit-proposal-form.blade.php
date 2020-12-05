@props(['proposal' => $proposal])
@php
    /**
     * @var \App\Entities\Proposal\Proposal $proposal
     */
@endphp

<x-forms.offers.elements.form-frame
    :action="route('freelancer.dashboard.proposals.update', ['offer' => $proposal->getJob()->getId(), 'proposal'=> $proposal->getUuid()])">
    @csrf
    @method('PUT')
    <x-forms.offers.elements.cover-letter :description="$proposal->getCoverLetter()"/>


    <div class="form-group form-row align-items-start mt-4">
        <label for="estimated_time" class="form-info h3 mb-2 mt-0 col-12">
            {{ trans('texts.dashboard.proposals.create-form.estimated_time') }}:
        </label>
        <div class="col-10">
            <input id="estimated_time" name="estimated_time" type="number"
                   class="form-control @error('estimated_time') is-invalid @enderror"
                   placeholder="{{ trans('texts.dashboard.proposals.create-form.estimated_time') }}" required="required"
                   value="{{ old('estimated_time', $proposal->getEstimatedTime()->toFullHours()) }}">

            <x-forms.elements.error-feedback name="estimated_time"/>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <x-buttons.submit.main>
                {{ trans('texts.dashboard.offers.edit.submit') }}
            </x-buttons.submit.main>
        </div>
    </div>


</x-forms.offers.elements.form-frame>
