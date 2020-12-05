@php($id = $id ?? $name)

<label for="{{ $id }}" class="form-info @error('password') error @enderror">
    {{ $label }}
</label>

<div class="input-group mb-1" data-password-showable
     data-password-link-selector=".show-hide-password-link"
     data-password-icon-selector="i">

    <x-forms.auth.elements.show-hide-password-input :name="$name"
                                                    :id="$id"
                                                    :placeholder="trans('texts.auth.password')"/>
</div>


@section('bottom-scripts')
    @parent

    @include('components.scripts.show-hide-password')
@endsection
