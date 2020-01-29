@extends('admin.layout.app')

@section('title', trans('global.actions.objects.creation', ['object' => 'Exchange']))

@section('content')
    {!! Form::open(['url' => route('admin.settings.exchanges.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('global.blade.title.exchange') }}
            </h3>
        </div>

        <div class="card-body">
            {{ Form::bsSwitch('global.blade.fields.status', 'status') }}

            {{ Form::bsText('global.blade.fields.name', 'name') }}

            <div class="row">
                <div class="col-md-6">
                    {{ Form::bsText('global.blade.fields.link', 'link') }}
                </div>

                <div class="col-md-6">
                    {{ Form::bsSelectWithoutSearch('global.blade.fields.network_id', 'network_id', $networks, true) }}
                </div>
            </div>

            {{ Form::bsTextarea('global.blade.fields.description', 'description', false) }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-footer text-right">
                    {{ Form::submit(trans('global.actions.objects.save', ['object' => 'exchange']), ['class' => 'btn btn-success']) }}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@endsection
