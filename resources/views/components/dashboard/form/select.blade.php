<div class="form-group @error($name) has-error @enderror">
    <label for="{{ $name }}">{{ trans($label) }} {{ $isRequired ? '*' : '' }}</label>

    {!! Form::select($name, $isRequired ? $options : [null => trans('global.blade.list.select_one')] + $options, $value ?? null, array_merge(
        ['class' => 'select2 ' . ($errors->has($name) ? 'form-control is-invalid' : (old($name) !== null ? 'form-control is-valid' : 'form-control'))],
        $attributes
     )) !!}

    @error($name)
    <p class="help-block">{{ $errors->first($name) }}</p>
    @enderror

    <p class="helper-block">
        {{ $help }}
    </p>
</div>