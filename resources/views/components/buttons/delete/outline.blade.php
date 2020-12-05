@props(['sendForm'])
<button {{ $attributes->merge([
            'type' => 'button',
            'class'=> 'btn btn-outline-danger btn-block main-btn'
        ]) }}
        onclick="event.preventDefault(); $('{{ $sendForm }}').submit();">
    {{ $slot }}
</button>
