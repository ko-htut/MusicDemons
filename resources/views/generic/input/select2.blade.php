<?php use App\Helpers\Functions; ?>

<select class="form-control select2 w-100"
    name="{{ (isset($multiple) && !!$multiple) ? $name . '[]' : $name }}"
    id="{{ $name }}"
    data-placeholder="{{ $placeholder }}"
    {!! isset($ajax) ? ("data-url=\"" . $ajax['url'] . "\"") : "" !!}
    {!! isset($ajax) ? ("data-method=\"" . $ajax['method'] . "\"") : "" !!}
    data-selected="{!! (old($name) !== null) ? Functions::select2_selected(app($model)::find(old($name))) : Functions::select2_selected($selected) !!}"
    {!! isset($ajax) ? "" : ("data-items=\"" . Functions::select2_selected($items) . "\"") !!}
    {{ (isset($multiple) && !!$multiple) ? "multiple" : "" }}
    {{ (isset($required) && !!$required) ? "required" : "" }}
    {{ (isset($disabled) && !!$disabled) ? "disabled" : "" }}>
</select>