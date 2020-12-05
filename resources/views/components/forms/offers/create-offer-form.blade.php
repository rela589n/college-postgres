@php
    /**
     * @var \App\Entities\Job\Job $job
     */
@endphp

<x-forms.offers.elements.form-frame :action="route('customer.dashboard.offers.store')">
    @csrf
    @method('POST')

    <x-forms.offers.elements.input-public-name />

    <x-forms.offers.elements.input-description />

    <div class="row">
        <div class="col-12">
            <x-buttons.submit.main>
                {{ trans('texts.dashboard.offers.edit.submit') }}
            </x-buttons.submit.main>
        </div>
    </div>

</x-forms.offers.elements.form-frame>
