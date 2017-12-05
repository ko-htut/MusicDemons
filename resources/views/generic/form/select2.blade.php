<div class="form-group row">
    <label for="{{ $name }}" class="col-sm-4 col-xl-2">{{ $label }}</label>
    <div class="col-sm-8 col-xl-10">
        <select class="form-control select2"
            name="{{ $name }}[]"
            id="artists"
            data-placeholder="{{ $label }}"
            data-url="{{ $url }}"
            data-selected="{!! (old($name) !== null) ? App\Helpers\Functions::select2_selected(app('App\\Entities\\' . $model)::find(old($name))) : (empty($selected) ? '[]' : App\Helpers\Functions::select2_selected($selected)) !!}"
            multiple>
        </select>
    </div>
</div>