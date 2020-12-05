@props(['date' => optional($date ?? null)])
@php
    /**
     * @var \App\ValueObjects\DeletionDate\DeletionDate $date
     */
@endphp

<div class="form-group form-row align-items-start mt-4">
    <label for="name" class="form-info h3 m-0 col-5">
        {{ trans('texts.dashboard.offers.select-date-to-delete') }}:
    </label>
    <div class="col-7">
        <x-forms.elements.datepicker name="date_to_delete"
                                     :value="old('date_to_delete', $date->format('Y-m-d'))"/>

        <x-forms.elements.error-feedback name="date_to_delete"/>
    </div>
</div>
