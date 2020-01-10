<div class="form-group @error($name) has-error @enderror">
    @if ($value)
        <div class="preview_image">
            <img src="{{ Storage::url($value) }}" width="100%"/>
        </div>
    @endif

    <div class="custom-file">
        {{ Form::file($name, ['class' => 'custom-file-input', 'id' => $name]) }}

        <label for="{{ $name }}" class="custom-file-label">{{ trans($label) }} {{ $isRequired ? '*' : '' }}</label>
    </div>

    @error($name)
    <p class="help-block">{{ $errors->first($name) }}</p>
    @enderror

    <p class="helper-block">
        {{ $help }}
    </p>
</div>