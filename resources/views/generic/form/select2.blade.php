<div class="form-group row"{!! isset($id) ? (" id=\"$id\"") : "" !!}>
    <label for="{{ $name }}" class="col-sm-4 col-xl-2">{{ $label }}</label>
    <div class="col-sm-8 col-xl-10">
        @if(isset($ajax))
            @component('generic.input.select2',[
                'name'             =>  $name,
                'multiple'         =>  (isset($multiple) && !!$multiple),
                'required'         =>  (isset($required) && !!$required),
                'disabled'         =>  (isset($disabled) && !!$disabled),
                'placeholder'      =>  $label,
                'selected'         =>  $selected ?? array(),
                'ajax'             =>  [
                    'url'            =>  $ajax['url'],
                    'method'         =>  $ajax['method'] ?? 'get'
                ],
                'model'        =>  $model
            ])@endcomponent
        @else
            @component('generic.input.select2',[
                'name'             =>  $name,
                'multiple'         =>  (isset($multiple) && !!$multiple),
                'required'         =>  (isset($required) && !!$required),
                'disabled'         =>  (isset($disabled) && !!$disabled),
                'placeholder'      =>  $label,
                'items'            =>  $items,                
                'selected'         =>  $selected ?? array(),
                'model'            =>  $model
            ])@endcomponent
        @endif
    </div>
</div>