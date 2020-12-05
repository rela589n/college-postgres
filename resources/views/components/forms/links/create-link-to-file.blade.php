<x-forms.files.elements.form-frame :action="route('dashboard.links.store', $file)">
    @csrf

    <x-forms.links.elements.select-link-type/>

    <x-buttons.submit.main>{{ trans('texts.dashboard.file-links.create-form.submit') }}</x-buttons.submit.main>

</x-forms.files.elements.form-frame>
