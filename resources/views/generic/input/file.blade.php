{{-- generic.input.file(name, accept, [required], [disabled]) --}}
<input
        type="file"
        class="form-control"
        name="{{ $name }}"
        id="{{ $name }}"
        accept="{{ $accept }}"
        {{ (isset($required) && !!$required) ? ' required' : '' }}
        {{ (isset($disabled) && !!$disabled) ? ' disabled' : '' }}>