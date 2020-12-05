<form method="post" class="@section('form-class') auth @show ">
    @csrf
    @section('auth-form-header')
        <h2 class="mb-0">{{ trans('texts.auth.sign-in') }}</h2>
        <a href="{{ route('freelancer.auth.login') }}" class="d-block mt-0">{{ trans('texts.auth.are-you-freelancer') }}</a>
    @show

    <x-forms.auth.elements.login-input/>

    <x-forms.auth.elements.password-input name="password"
                                          :label="trans('texts.auth.password')"/>

    @section('remember-checkbox')
        <input id="remember" name="remember" type="checkbox" @if(old('remember')) checked="checked" @endif>
    @show

    @section('remember-label')
        <label for="remember" class="form-info">{{ trans('texts.auth.remember') }}</label>
    @show

    <x-forms.auth.elements.submit-button/>
</form>
