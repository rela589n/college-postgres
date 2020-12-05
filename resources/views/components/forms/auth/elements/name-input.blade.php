@section('name-label')
    <label for="name" class="form-info">
        {{ trans('texts.auth.name') }}
    </label>
@show

@section('name-input')
    <input id="name" name="name" type="text"
           class="form-control @error('name') is-invalid @enderror"
           placeholder="{{ trans('texts.auth.name') }}"
           required="required"
           value="{{ old('name') }}">

    @error('name')
    <span class="invalid-feedback" role="alert"><label for="name">{{ $message }}</label></span>
    @enderror
@show
