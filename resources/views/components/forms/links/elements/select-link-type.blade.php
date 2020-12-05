<div class="form-group form-row align-items-start">
    <label for="link_type" class="form-info h3 m-0 col-3">
        {{ trans('texts.dashboard.file-links.form-elements.select-type') }}
    </label>
    <div class="col-9">
        <select required name="link_type" id="link_type" class="custom-select my-1 mr-sm-2">
            <option value="" selected>{{ trans('texts.dashboard.file-links.form-elements.select-default') }}:</option>
            <option value="unlimited">{{ trans('texts.entities.link-token.types.unlimited') }}</option>
            <option value="disposable">{{ trans('texts.entities.link-token.types.disposable') }}</option>
        </select>
    </div>
</div>
