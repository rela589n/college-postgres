<input id="{{ $id ?? $name }}" name="{{ $name }}" type="password"
       class="form-control @error($name) is-invalid @enderror"
       @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
       value="{{ old($name) }}"
       @if($required ?? true) required="required" @endif>

<div class="input-group-append">
    <a href="javascript: void(0);" tabindex="-1" class="input-group-text show-hide-password-link"><i class="fa fa-eye"
                                                                                                     aria-hidden="true"></i></a>
</div>

@error($name)
<span class="invalid-feedback" role="alert"><label
        for="{{ $id ?? $name }}">{{ $message }}</label></span>
@enderror
