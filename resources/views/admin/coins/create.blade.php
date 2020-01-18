@extends('admin.layout.app')

@section('title', trans('global.actions.objects.creation', ['object' => 'Coin']))

@section('content')
    {!! Form::open(['url' => route('admin.coins.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ trans('coin.title_edit') }}
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                data-toggle="tooltip"
                                title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    {{ Form::bsSwitch('global.blade.fields.status', 'status') }}

                    <div class="row">
                        <div class="col-md-4">
                            {{ Form::bsText('global.blade.fields.name', 'name') }}
                        </div>

                        <div class="col-md-4">
                            {{ Form::bsText('global.blade.fields.code', 'code') }}
                        </div>

                        <div class="col-md-4">
                            {{ Form::bsSelectWithoutSearch('global.blade.fields.type', 'type', CoinTypeDictionary::getValues(), true, CoinTypeDictionary::TYPE_COIN) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" id="typeSwitch">
                            <span class="for_coin">
                                <br>
                                {{ Form::bsSwitch('coin.blade.create.form.smart_contracts', 'smart_contracts', false) }}
                            </span>

                            <span class="for_token" style="display: none">
                                {{ Form::bsText('coin.blade.create.form.platform', 'platform', false) }}
                            </span>
                        </div>

                        <div class="col-md-6">
                            {{ Form::bsDate('coin.blade.create.form.date_start', 'date_start', false) }}
                        </div>

                        <div class="col-md-6">
                            {{ Form::bsSelect('coin.blade.create.form.algorithm.encryption', 'encryption', $algorithms['encryption'], false) }}
                        </div>

                        <div class="col-md-6">
                            {{ Form::bsSelect('coin.blade.create.form.algorithm.consensus', 'consensus', $algorithms['consensus'], false) }}
                        </div>

                        <div class="col-md-6">
                            <br>
                            {{ Form::bsSwitch('coin.blade.create.form.mining', 'mining', false) }}
                        </div>

                        <div class="col-md-6">
                            {{ Form::bsText('coin.blade.create.form.max_supply', 'max_supply', false) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::bsTextarea('coin.blade.create.form.key_features', 'key_features', false) }}
                            {{ Form::bsTextarea('coin.blade.create.form.use', 'use', false) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ trans('coin.blade.general.icon') }}
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            {{ Form::bsFile('coin.blade.create.form.icon', 'image', false) }}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ trans('coin.blade.general.links') }}
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            {{ Form::bsText('coin.blade.create.form.site', 'site', false) }}
                            {{ Form::bsText('coin.blade.create.form.chat', 'chat', false) }}
                            {{ Form::bsTextMultiple('coin.blade.create.form.link', 'link') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-footer text-right">
                    {{ Form::submit(trans('global.actions.objects.save', ['object' => 'coin']), ['class' => 'btn btn-success']) }}

                    {{ Form::submit(trans('global.actions.save_edit'), ['class' => 'btn btn-info', 'name' => 'editing']) }}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@endsection

@push('added-js')
    <script>
        $(function () {
            let type = $('select[name=type]');

            changeType(type.val());

            type.on('change', function () {
                changeType($(this).val());
            });
        });

        function changeType(type) {
            let typeSwitch = $('#typeSwitch');

            typeSwitch.find('span').hide();

            if (type === "{{ CoinTypeDictionary::TYPE_COIN }}") {
                typeSwitch.find('.for_coin').show();
            } else {
                typeSwitch.find('.for_token').show();
            }
        }
    </script>
@endpush