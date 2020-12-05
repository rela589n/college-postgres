<div class="form-group form-row align-items-start">
    <label for="file" class="form-info h3 m-0 col-3">
        {{ trans('texts.dashboard.offers.select-file') }}:
    </label>
    <div class="col-9">
        <input id="file" name="file" class="form-control @error('file') is-invalid @enderror" type="file">

        <x-forms.elements.error-feedback name="file"/>
    </div>
</div>
