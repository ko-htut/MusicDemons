{{-- generic.input.togglebutton(name, [value], [disabled])  --}}
<label class="switch medium">
    {{-- Default value (otherwise, when checkbox is unchecked, the name would not be posted) --}}
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox"
           name="{{ $name }}"
           id="{{ $name }}"
           {{ (isset($disabled) && !!$disabled) ? ' disabled' : '' }}
           {{-- Now we really know whether or not the form is in postback --}}
           {{ (old($name) !== null ? (old($name) == 1) : (isset($value) && !!$value)) ? " checked" : "" }}>
  <span class="slider round"></span>
</label>