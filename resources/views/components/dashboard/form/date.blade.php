<div class="form-group @error($name) has-error @enderror">
    <label for="{{ $name }}">{{ trans($label) }} {{ $isRequired ? '*' : '' }}</label>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
            </span>
        </div>

        {!! Form::text($name, $value, array_merge(
            [
                'class' => 'form-control float-right' . ($errors->has($name) ? 'form-control is-invalid' : (old($name) !== null ? 'form-control is-valid' : '')),
                'id' => "date-input-{$name}"
            ],
            $attributes
        )) !!}
    </div>

    @error($name)
    <p class="help-block">{{ $errors->first($name) }}</p>
    @enderror

    <p class="helper-block">
        {{ $help }}
    </p>
</div>

@push('added-js')
    <script>
        $(function () {
            let input = $("#{{ "date-input-{$name}" }}");

            input.daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                //autoUpdateInput: true,
                locale: {
                    format: 'Y-MM-DD'
                }
            });
        });
    </script>
@endpush