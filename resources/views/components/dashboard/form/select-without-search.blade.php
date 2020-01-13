<div class="form-group @error($name) has-error @enderror">
    @if ($label)
        <label for="{{ $name }}">{{ trans($label) }} {{ $isRequired ? '*' : '' }}</label>
    @endif

    {!! Form::select($name, $options, $value, array_merge(
        [
            'class' => 'select2-without-search ' . ($errors->has($name) ? 'form-control is-invalid' : (old($name) !== null ? 'form-control is-valid' : 'form-control')),
            'style' => 'width: 100%'
        ],
        $attributes
     )) !!}

    @error($name)
    <p class="help-block">{{ $errors->first($name) }}</p>
    @enderror

    <p class="helper-block">
        {{ $help }}
    </p>
</div>