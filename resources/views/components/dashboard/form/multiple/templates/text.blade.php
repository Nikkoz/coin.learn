<div class="row {{ $key ? 'pt-2' : '' }}">
    <div class="col-10 pr-0">
        {!! Form::text($name, $value, array_merge(
            ['class' => $errors->has($name) ? 'form-control is-invalid' : (old($name) !== null ? 'form-control is-valid' : 'form-control')],
            $attributes
        )) !!}
    </div>

    <div class="col-2 text-right">
        <a href="#" class="btn {{ $key === 0 ? 'btn-success input-add' : 'btn-danger input-remove' }}">
            <i class="fas fa-{{ $key === 0 ? 'plus' : 'minus' }}"></i>
        </a>
    </div>
</div>