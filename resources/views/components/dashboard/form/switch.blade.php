<div class="form-group @error($name) has-error @enderror">
    <div class="custom-control custom-switch">
        {{ Form::checkbox($name, 0, true, ['class' => 'hide']) }}
        {{ Form::checkbox($name, 1, $value, ['class' => 'custom-control-input', 'id' => $name]) }}

        <label for="{{ $name }}" class="custom-control-label">
            {{ trans($label) }}
        </label>

        @error($name)
        <p class="help-block">{{ $errors->first($name) }}</p>
        @enderror

        <p class="helper-block">
            {{ $help }}
        </p>
    </div>
</div>