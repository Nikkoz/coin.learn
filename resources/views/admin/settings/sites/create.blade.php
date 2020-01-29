@extends('admin.layout.app')

@section('title', trans('global.actions.objects.creation', ['object' => 'Site']))

@section('content')
    {!! Form::open(['url' => route('admin.settings.sites.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('sites.title_one') }}
            </h3>
        </div>

        <div class="card-body">
            {{ Form::bsSwitch('global.blade.fields.status', 'status') }}

            {{ Form::bsText('global.blade.fields.name', 'name') }}

            {{ Form::bsText('global.blade.fields.link', 'link') }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-footer text-right">
                    {{ Form::submit(trans('global.actions.objects.save', ['object' => 'site']), ['class' => 'btn btn-success']) }}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@endsection
