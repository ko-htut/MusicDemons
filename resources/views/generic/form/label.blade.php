{{-- generic.form.label(label, value, [labelColClass], [inputColClass]) --}}
<?php $labelColClass = isset($labelColClass) ? $labelColClass : 'col-sm-4 col-xl-2' ?>
<?php $inputColClass = isset($inputColClass) ? $inputColClass : 'col-sm-8 col-xl-10' ?>
<div class="row">
    <div class="{{ $labelColClass }}">
        <label class="bold">{{ $label }}</label>
    </div>
    <div class="{{ $inputColClass }}">
        <label>{{ $value }}</label>
    </div>
</div>