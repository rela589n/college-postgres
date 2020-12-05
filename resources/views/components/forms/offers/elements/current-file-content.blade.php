@php
    /**
     * @var \App\Models\File $file
     */
@endphp

<div class="form-row my-3">
    <div class="col-3 h3">
        {{ trans('texts.dashboard.offers.edit.current-content') }}:
    </div>
    <div class="col-9">
        <x-images.main :src="$file->location->url()"
                       :alt="$file->description->publicName()"/>
    </div>
</div>
