@extends('admin.layout.app')

@section('title', trans('global.actions.objects.creation', ['object' => 'Post']))

@section('content')
    {!! Form::open(['url' => route('admin.news.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    {{ Form::hidden('type', PostTypeDictionary::TYPE_POST) }}

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('global.blade.title.post') }}
            </h3>
        </div>

        <div class="card-body">
            {{ Form::bsSwitch('global.blade.fields.status', 'status') }}

            <div class="row">
                <div class="col-md-6">
                    {{ Form::bsText('global.blade.fields.title', 'title') }}
                </div>

                <div class="col-md-6">
                    {{ Form::bsText('global.blade.fields.section', 'section', true) }}
                </div>

                <div class="col-md-6">
                    {{ Form::bsText('global.blade.fields.link', 'link') }}
                </div>

                <div class="col-md-6">
                    {{ Form::bsSelect('global.blade.fields.site', 'site_id', $sites, true) }}
                </div>

                <div class="col-md-6">
                    {{ Form::bsDateTime('global.blade.fields.date', 'created') }}
                </div>

                <div class="col-md-6">
                    {{ Form::bsSelectMultiple('global.blade.fields.handbooks', 'handbooks[]', $handbooks, false) }}
                </div>
            </div>

            {{ Form::bsTextarea('global.blade.fields.text', 'text') }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-footer text-right">
                    {{ Form::submit(trans('global.actions.objects.save', ['object' => 'post']), ['class' => 'btn btn-success']) }}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@endsection
