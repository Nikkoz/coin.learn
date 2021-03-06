@extends('admin.coins.menu')

@section('title', trans('global.actions.objects.creation', ['object' => 'Handbook']))

@section('inner_content')
    {!! Form::open(['url' => route('admin.coins.handbooks.store', $coin->id), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('handbooks.title_one') }}
            </h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    {{ Form::bsSwitch('global.blade.fields.status', 'status') }}
                </div>

                <div class="col-md-6">
                    {{ Form::bsSwitch('global.blade.fields.check_case', 'check_case') }}
                </div>

                <div class="col-md-6">
                    {{ Form::bsText('global.blade.fields.title', 'title') }}
                </div>

                <div class="col-md-6">
                    {{ Form::bsSelect('global.blade.fields.coin', 'coin_id', $coins, true, $coin->id) }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-footer text-right">
                    {{ Form::hidden('coin_id', $coin->id) }}
                    {{ Form::submit(trans('global.actions.objects.save', ['object' => 'handbook']), ['class' => 'btn btn-success']) }}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@endsection
