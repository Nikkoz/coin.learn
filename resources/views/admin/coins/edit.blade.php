@extends('admin.coins.menu')

@section('title', trans('coin.blade.edit.title'))

@section('inner_content')
    {!! Form::open(['url' => route('admin.coins.update', $coin->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $coin->name }}
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
                    {{ Form::bsSwitch('coin.blade.status', 'status', $coin->status) }}

                    <div class="row">
                        <div class="col-md-4">
                            {{ Form::bsText('coin.blade.name', 'name', true, $coin->name) }}
                        </div>

                        <div class="col-md-4">
                            {{ Form::bsText('coin.blade.create.form.code', 'code', true, $coin->code) }}
                        </div>

                        <div class="col-md-4">
                            {{ Form::bsSelectWithoutSearch('coin.blade.type', 'type', CoinTypeDictionary::getValues(), true, $coin->type) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" id="typeSwitch">
                            <span class="for_coin">
                                <br>
                                {{ Form::bsSwitch('coin.blade.create.form.smart_contracts', 'smart_contracts', $coin->smart_contracts) }}
                            </span>

                            <span class="for_token" style="display: none">
                                {{ Form::bsText('coin.blade.create.form.platform', 'platform', false, $coin->platform) }}
                            </span>
                        </div>

                        <div class="col-md-6">
                            {{ Form::bsDate('coin.blade.create.form.date_start', 'date_start', false, $coin->date_start) }}
                        </div>

                        <div class="col-md-6">
                            {{ Form::bsSelect('coin.blade.create.form.algorithm.encryption', 'encryption_id', $algorithms['encryption'], false, $coin->encryption_id) }}
                        </div>

                        <div class="col-md-6">
                            {{ Form::bsSelect('coin.blade.create.form.algorithm.consensus', 'consensus_id', $algorithms['consensus'], false, $coin->consensus_id) }}
                        </div>

                        <div class="col-md-6">
                            <br>
                            {{ Form::bsSwitch('coin.blade.create.form.mining', 'mining', $coin->mining) }}
                        </div>

                        <div class="col-md-6">
                            {{ Form::bsText('coin.blade.create.form.max_supply', 'max_supply', false, $coin->max_supply) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::bsTextarea('coin.blade.create.form.key_features', 'key_features', false, $coin->key_features) }}
                            {{ Form::bsTextarea('coin.blade.create.form.use', 'use', false, $coin->use) }}
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
                            {{ Form::bsFile('coin.blade.create.form.icon', 'image_id', false, $coin->image->path) }}
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
                            {{ Form::bsText('coin.blade.create.form.site', 'site', false, $coin->site) }}
                            {{ Form::bsText('coin.blade.create.form.chat', 'chat', false, $coin->chat) }}
                            {{ Form::bsTextMultiple('coin.blade.create.form.link', 'links', false, $coin->links ?? []) }}
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
                    {{ Form::submit(trans('coin.blade.save'), ['class' => 'btn btn-success']) }}
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