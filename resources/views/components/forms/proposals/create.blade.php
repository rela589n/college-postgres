<x-forms.offers.elements.form-frame :action="route('freelancer.dashboard.proposals.store')">
    @csrf

    <x-forms.offers.elements.input-public-name/>

    <x-forms.offers.elements.input-description/>

    <div class="row">
        <div class="col-12">
            <x-buttons.submit.main>
                {{ trans('texts.dashboard.offers.create.submit') }}
            </x-buttons.submit.main>
        </div>
    </div>
</x-forms.offers.elements.form-frame>
