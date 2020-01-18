@extends('admin.layout.app')

@section('title', trans('global.actions.update', ['object' => 'Network']))

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ trans('settings.blade.socials.networks.name', ['name' => $network->name]) }}
                    </h3>
                </div>

                {!! Form::open(['url' => route('admin.settings.social.networks.update', $network->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

                <div class="card-body">
                    {{ Form::bsSwitch('global.blade.fields.status', 'status', $network->status) }}

                    {{ Form::bsText('settings.blade.socials.network', 'name', true, $network->name) }}

                    {{ Form::bsText('settings.blade.socials.link', 'link', true, $network->link) }}
                </div>

                <div class="card-footer text-right">
                    {{ Form::submit(trans('settings.blade.socials.form.btn_update'), ['class' => 'btn btn-success']) }}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection