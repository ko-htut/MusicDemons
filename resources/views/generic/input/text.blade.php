{{-- generic.input.text(name, [value], [placeholder], [required], [autofocus], [disabled]) --}}
<input
        type="text"
        class="form-control"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name) !== null ? old($name) : ( isset($value) ? $value : null ) }}"
        placeholder="{{ isset($placeholder) ? $placeholder : null }}"
        {{ (isset($required) && !!$required) ? ' required' : '' }}
        {{ (isset($disabled) && !!$disabled) ? ' disabled' : '' }}
        {{ (isset($autofocus) && !!$autofocus) ? ' autofocus' : '' }}>