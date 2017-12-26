{{-- generic.input.textarea(name, [value], [required], [autofocus], [disabled]) --}}
<?php $rows = isset($rows) ? $rows : 15 ?>
<textarea
        class="form-control"
        rows="{{ $rows }}"
        name="{{ $name }}"
        id="{{ $name }}"
        {{ (isset($required) && !!$required) ? ' required' : '' }}
        {{ (isset($disabled) && !!$disabled) ? ' disabled' : '' }}
        {{ (isset($autofocus) && !!$autofocus) ? ' autofocus' : '' }}>{{ old($name) !== null ? old($name) : ( isset($value) ? $value : null ) }}</textarea>