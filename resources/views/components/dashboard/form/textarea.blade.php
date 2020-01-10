<div class="form-group @error($name) has-error @enderror">
    <label for="{{ $name }}">{{ trans($label) }} {{ $isRequired ? '*' : '' }}</label>

    {!! Form::textarea($name, $value, array_merge(
        [
            'class' => 'summernote ' . ($errors->has($name) ? 'form-control is-invalid' : (old($name) !== null ? 'form-control is-valid' : 'form-control')),
            'data-image-url' => route('admin.ajax.upload.image')
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