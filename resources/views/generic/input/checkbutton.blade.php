{{-- generic.input.checkbutton(name, text, value, [disabled])  --}}

<?php $val = empty(old($name)) ? $checked : array_key_exists($value,old($name)); ?>
<label>
    <button type="button" class="btn check-btn {{ $val ? 'btn-primary' : 'btn-secondary' }}">{{ $text }}</button>
    <input type="hidden" name="{{ $name . '[]' }}" value="{{ $val ? $value : '' }}" data-value="{{ $value }}">
</label>