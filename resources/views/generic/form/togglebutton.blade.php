{{-- generic.form.togglebutton(name) --}}
<?php $labelColClass = isset($labelColClass) ? $labelColClass : 'col-sm-4 col-xl-2' ?>
<?php $inputColClass = isset($inputColClass) ? $inputColClass : 'col-sm-8 col-xl-10' ?>
<div class="form-group row{{ $errors->has($name) ? ' has-danger' : '' }}">
  	<label for="{{ $name }}" class="{{ $labelColClass }}">{{ $label }}</label>
  	<div class="{{ $inputColClass }}">
    		@component('generic.input.togglebutton', [
    				'name' => $name,
    				'value' => isset($value) ? $value : 0,
    				'disabled' => (isset($disabled) && !!$disabled) ? true : false
    		])@endcomponent
    </div>
		@if ($errors->has($name))
			  <div class="form-control-feedback">{{ $errors->first($name) }}</div>
		@endif
</div>