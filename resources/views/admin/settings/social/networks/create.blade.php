@extends('admin.layout.app')

@section('title', trans('global.actions.add', ['object' => 'Network']))

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ trans('settings.blade.socials.networks.network') }}
                    </h3>
                </div>

                {!! Form::open(['url' => route('admin.settings.social.networks.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                <div class="card-body">
                    {{ Form::bsSwitch('global.blade.fields.status', 'status') }}

                    {{ Form::bsText('settings.blade.socials.network', 'name') }}

                    {{ Form::bsText('settings.blade.socials.link', 'link') }}
                </div>

                <div class="card-footer text-right">
                    {{ Form::submit(trans('settings.blade.socials.form.btn_save'), ['class' => 'btn btn-success']) }}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection