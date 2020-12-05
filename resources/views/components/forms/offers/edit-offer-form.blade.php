@php
    /**
     * @var \App\Entities\Job\Job $job
     */
@endphp

<x-forms.offers.elements.form-frame :action="route('customer.dashboard.offers.update', $job->getId())">
    @csrf
    @method('PUT')

    <x-forms.offers.elements.input-public-name :title="$job->getTitle()"/>

    <x-forms.offers.elements.input-description :description="$job->getDescription()"/>

    <div class="row">
        <div class="col-7">
            <x-buttons.submit.main>
                {{ trans('texts.dashboard.offers.edit.submit') }}
            </x-buttons.submit.main>
        </div>
        <div class="col-5">
            <x-buttons.delete.main sendForm="#delete-file-hidden-form">
                {{ trans('texts.dashboard.offers.delete.button') }}
            </x-buttons.delete.main>
        </div>
    </div>

</x-forms.offers.elements.form-frame>

<x-forms.common.delete id="delete-file-hidden-form"
                       :action="route('customer.dashboard.offers.destroy', $job->getId())"/>
