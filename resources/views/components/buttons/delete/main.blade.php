<button type="button"
        class="btn btn-sm btn-danger btn-block main-btn mb-4 mt-3"
        onclick="event.preventDefault(); $('{{ $sendForm }}').submit();">
    {{ $slot }}
</button>
