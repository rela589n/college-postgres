@section('login-label')
    <label for="login" class="form-info">
        {{ trans('texts.auth.login') }}
    </label>
@show

@section('login-input')
    <input id="login" name="login" type="text"
           class="form-control @error('login') is-invalid @enderror"
           placeholder="{{ trans('texts.auth.login-placeholder') }}"
           required="required"
           value="{{ old('login') }}">

    @error('login')
    <span class="invalid-feedback" role="alert"><label for="login">{{ $message }}</label></span>
    @enderror
@show
