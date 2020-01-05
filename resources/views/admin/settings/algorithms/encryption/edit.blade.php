@extends('admin.layout.app')

@section('title', trans('settings.blade.algorithms.updated', ['name' => $algorithm->name]))

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ trans('settings.blade.algorithms.encryption.title') }}
                    </h3>
                </div>

                {!! Form::open(['url' => route('admin.settings.algorithms.encryption.update', $algorithm->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

                <div class="card-body">
                    {{ Form::bsText('settings.blade.algorithms.form.name', 'name', true, $algorithm->name) }}
                </div>

                <div class="card-footer text-right">
                    {{ Form::submit(trans('settings.blade.algorithms.form.btn_update'), ['class' => 'btn btn-success']) }}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection