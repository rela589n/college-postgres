@props(['description' => ($description ?? null)])

<div class="form-group form-row align-items-start mt-4">

    <label for="description" class="form-info h3 mb-2 mt-0 col-12">
        {{ trans('texts.dashboard.proposals.create-form.cover-letter') }}:
    </label>
    <div class="col-12">
        <x-forms.elements.textarea name="description"
                                   required="required"
                                   :placeholder="trans('texts.dashboard.proposals.create-form.cover-letter')">
            {{ old('description', $description) }}
        </x-forms.elements.textarea>

        <x-forms.elements.error-feedback name="description"/>
    </div>
</div>
