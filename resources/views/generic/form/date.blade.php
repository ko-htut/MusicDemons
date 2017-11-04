{{-- generic.form.date(name, label, [value], [placeholder], [required], [autofocus], [disabled], [labelColClass], [inputColClass]) --}}
<?php $labelColClass = isset($labelColClass) ? $labelColClass : 'col-sm-4 col-xl-2' ?>
<?php $inputColClass = isset($inputColClass) ? $inputColClass : 'col-sm-8 col-xl-10' ?>
<div class="form-group row{{ $errors->has($name) ? ' has-danger' : '' }}">
    <label for="{{ $name }}" class="{{ $labelColClass }}">{{ $label }}</label>
    <div class="{{ $inputColClass }}">
        @component('generic.input.date', [
            'name' => $name,
            'value' => isset($value) ? $value : null,
            'placeholder' => isset($placeholder) ? $placeholder : null,
            'required' => (isset($required) && !!$required) ? true : false,
            'autofocus' => (isset($autofocus) && !!$autofocus) ? true : false,
            'disabled' => (isset($disabled) && !!$disabled) ? true : false
        ])@endcomponent
        @if ($errors->has($name))
            <div class="form-control-feedback">{{ $errors->first($name) }}</div>
        @endif
    </div>
</div>