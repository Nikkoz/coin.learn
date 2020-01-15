@extends('admin.coins.menu')

@section('title', trans('global.actions.objects.update', ['object' => 'Link']))

@section('inner_content')
    {!! Form::open(['url' => route('admin.links.update', ['coinId' => $coin->id, 'id' => $link->id]), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('coin.links.title_one') }}
            </h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    {{ Form::bsText('global.blade.fields.link', 'link', true, $link->link) }}
                </div>

                <div class="col-md-6">
                    {{ Form::bsSelectWithoutSearch('global.blade.fields.network', 'network_id', $networks, true, $link->network_id) }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    {{ Form::bsTextarea('global.blade.fields.description', 'description', false, $link->description) }}
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-footer text-right">
                    {{ Form::hidden('coin_id', $coin->id) }}
                    {{ Form::submit(trans('global.actions.objects.save', ['object' => 'link']), ['class' => 'btn btn-success']) }}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@endsection
