@props(['id' => $name, 'name'])
@error($name)
<span class="invalid-feedback" role="alert">
    <label for="{{ $id }}">{{ $message }}</label>
</span>
@enderror
