@props(['title' => ($title ?? null)])

<div class="form-group form-row align-items-start mt-4">
    <label for="public_name" class="form-info h3 m-0 col-2">
        {{ trans('texts.dashboard.offers.enter-name') }}:
    </label>
    <div class="col-10">
        <input id="public_name" name="public_name" type="text"
               class="form-control @error('public_name') is-invalid @enderror"
               placeholder="{{ trans('texts.dashboard.offers.enter-name') }}" required="required"
               value="{{ old('public_name', $title) }}">

        <x-forms.elements.error-feedback name="public_name"/>
    </div>
</div>
