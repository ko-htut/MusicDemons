{{-- generic.input.checkbutton(name, text, value, [disabled])  --}}

<?php $val = empty(old($name)) ? $checked : array_key_exists($value,old($name)); ?>
<label>
    <button type="button" class="btn check-btn {{ $val ? 'btn-primary' : 'btn-secondary' }}">{{ $text }}</button>
    <input type="checkbox" name="{{ $name . '[]' }}" value="{{ $value }}" {{ $val ? 'checked ' : '' }}class="d-none">
</label>