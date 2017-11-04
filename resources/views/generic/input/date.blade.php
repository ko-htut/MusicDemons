{{-- generic.input.date(name, [value], [placeholder], [required], [autofocus], [disabled]) --}}
<?php if($value !== null) { $val = date('Y-m-d',strtotime($value)); } ?>
<input
        type="date"
        class="form-control"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name) !== null ? old($name) : ( isset($val) ? $val : null ) }}"
        placeholder="{{ isset($placeholder) ? $placeholder : null }}"
        {{ (isset($required) && !!$required) ? ' required' : '' }}
        {{ (isset($disabled) && !!$disabled) ? ' disabled' : '' }}
        {{ (isset($autofocus) && !!$autofocus) ? ' autofocus' : '' }}>