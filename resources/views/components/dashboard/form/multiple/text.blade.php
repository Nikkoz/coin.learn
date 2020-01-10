<div class="form-group input-lg @error($name) has-error @enderror">
    <label for="{{ $name }}">{{ trans($label) }} {{ $isRequired ? '*' : '' }}</label>

    {!! Form::hidden($name) !!}

    <div class="multiple-text-input">
        @forelse ($value as $i => $v)
            @include('components.dashboard.form.multiple.templates.text', ['value' => $v, 'key' => $i, 'name' => "{$name}[{$i}]", 'attributes' => $attributes])
        @empty
            @include('components.dashboard.form.multiple.templates.text', ['value' => '', 'key' => 0, 'name' => "{$name}[0]", 'attributes' => $attributes])
        @endforelse
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
            let mainBlock = $('.multiple-text-input');

            $(document).on('click', '.input-add', function (e) {
                e.preventDefault();

                let count = mainBlock.find('.row').length;
                let name = "{{ $name }}";

                mainBlock.append('<div class="row pt-2">\
                                    <div class="col-10 pr-0">\
                                        <input class="form-control" name="' + name + '[' + count + ']" type="text" value="">\
                                    </div>\
                                    <div class="col-2 text-right">\
                                        <a href="#" class="btn btn-danger input-remove"><i class="fas fa-minus"></i></a>\
                                    </div>\
                                </div>');
            });

            $(document).on('click', '.input-remove', function (e) {
                e.preventDefault();

                $(this).closest('.row').remove();
            });
        });
    </script>
@endpush