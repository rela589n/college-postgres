@props(['id' => $name, 'name', 'value' => ''])
<input id="{{ $id }}" type="text"
       placeholder="{{ trans('texts.datepicker.date') }}" title="{{ trans('texts.datepicker.date') }}"
       class="form-control form-control-sm table-input-middle @error($name) is-invalid @enderror"
       data-datepicker data-pass-to="[name={{$name}}]" {{ $attributes }}>

<input type="hidden" name="{{ $name }}" value="{{ $value }}">

@section('head-styles')
    @parent
    <x-styles.bootstrap-datepicker/>
@endsection

@section('bottom-scripts')
    @parent
    <x-scripts.bootstrap-datepicker/>
    <x-scripts.init.datepicker.main/>
@endsection
