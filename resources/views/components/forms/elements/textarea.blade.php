@props(['id' => $name, 'name', 'placeholder' => ''])
<textarea id="{{ $id }}" name="{{ $name }}"
          class="form-control @error($name) is-invalid @enderror"
          rows="3" placeholder="{{ $placeholder }}"
          {{ $attributes }}>{{ $slot }}</textarea>
