<div class="form-group mb-4 mt-4 @error($name) has-error @enderror">
    <div class="col-xs-6 form-check icheckbox_minimal-purple">
        <input type="hidden" name="{{ $name }}" value="0"/>

        {{ Form::checkbox($name, 1, $value, ['class' => 'form-check-input', 'id' => $name]) }}

        @if (isset($label))
            <label class="form-check-label" for="{{ $name }}"><b>{{ trans($label) }}</b></label>
        @endif

        @error($name)
        <p class="help-block">{{ $errors->first($name) }}</p>
        @enderror

        <p class="helper-block">
            {{ $help }}
        </p>
    </div>
</div>