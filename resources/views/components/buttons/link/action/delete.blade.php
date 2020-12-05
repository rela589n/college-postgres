@props(['sendForm'])
<x-buttons.link.action.main :attributes="$attributes->merge([
                                'class' => 'btn-outline-danger',
                                'onclick' => 'event.preventDefault(); $(\''.$sendForm. '\').submit();'
                            ])">
    {{ $slot }}
</x-buttons.link.action.main>
