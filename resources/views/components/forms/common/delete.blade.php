<form id="{{ $id }}"
      action="{{ $action }}"
      method="POST"
      style="display: none;">
    @csrf
    @method('DELETE')
</form>
