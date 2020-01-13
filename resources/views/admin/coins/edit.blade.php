@extends('admin.layout.app')

@section('title', trans('coin.blade.edit.title'))

@section('content')
    {!! Form::open(['url' => route('admin.coins.update', $coin->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a href="#general" class="nav-link active" data-toggle="pill" role="tab">
                {{ trans('coin.blade.general.title') }}
            </a>
        </li>

        <li class="nav-item">
            <a href="#socials" class="nav-link" data-toggle="pill">
                {{ trans('coin.blade.socials.title') }}
            </a>
        </li>

        <li class="nav-item">
            <a href="#handbook" class="nav-link" data-toggle="pill">
                {{ trans('coin.blade.handbook.title') }}
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="general">
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
        </div>

        <div class="tab-pane" id="socials">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $coin->name }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-condensed table-renderer" id="group-inputs">
                            <thead>
                            <tr>
                                <th>{{ trans('coin.blade.socials.link') }}</th>
                                <th>{{ trans('coin.blade.socials.network') }}</th>
                                <th>{{ trans('coin.blade.socials.description') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($coin->socialLinks as $i => $link)
                                <tr data-link-id="{{ $link->id }}">
                                    <td>
                                        {{ Form::hidden("socials[{$link->id}]") }}
                                        {{ Form::bsText('', "socials[{$link->id}][link]", false, $link->link) }}
                                    </td>
                                    <td>{{ Form::bsSelectWithoutSearch('', "socials[{$link->id}][network_id]", $networks, false, $link->network->id) }}</td>
                                    <td>{{ Form::bsText('', "socials[{$link->id}][description]", false, $link->description) }}</td>
                                    <td>
                                        <a href="{{ route('admin.settings.social.links.destroy', $link->id) }}"
                                           class="btn {{ $i === 0 ? 'btn-success input-add' : 'btn-danger input-remove' }}">
                                            <i class="fas fa-{{ $i === 0 ? 'plus' : 'minus' }}"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        {{ Form::bsText('', 'newSocials[0][link]', false) }}
                                    </td>
                                    <td>{{ Form::bsSelectWithoutSearch('', 'newSocials[0][network_id]', $networks, false) }}</td>
                                    <td>{{ Form::bsText('', 'newSocials[0][description]', false) }}</td>
                                    <td>
                                        <a href="" class="btn btn-success input-add">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="handbook">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $coin->name }}
                    </h3>
                </div>
                <div class="card-body">

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

            addFields();
            removeFields();
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

        function addFields() {
            let mainBlock = $('#group-inputs');
            let iterator = 1;
            let selectValues = @json($networks);
            let options = '';

            $(document).on('click', '.input-add', function (e) {
                for (let key in selectValues) {
                    options += '<option value="' + key + '">' + selectValues[key] + '</option>';
                }

                mainBlock.append('<tr>\
                                    <td>\
                                        <div class="form-group input-lg">\
                                            <input class="form-control" name="newSocials[' + iterator + '][link]" type="text" value="">\
                                        </div>\
                                    </td>\
                                    <td>\
                                        <select name="newSocials[' + iterator + '][network_id]" class="select2_js_' + iterator + '" style="width: 100%">' + options + '</select>\
                                    </td>\
                                    <td>\
                                        <div class="form-group input-lg">\
                                            <input class="form-control" name="newSocials[' + iterator + '][description]" type="text" value="">\
                                        </div>\
                                    <td>\
                                        <a class="btn btn-danger input-remove">\
                                            <i class="fas fa-minus"></i>\
                                        </a>\
                                    </td>\
                                </tr>');

                $('.select2_js_' + iterator).select2({
                    minimumResultsForSearch: Infinity
                });

                iterator++;
            });
        }

        function removeFields() {
            $(document).on('click', '.input-remove', function (e) {
                e.preventDefault();

                if (confirm('{{ trans('global.blade.sure_delete') }}')) {
                    let url = $(this).attr('href');
                    let parent = $(this).closest('tr');

                    if (url === '') {
                        parent.remove();
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {_method: 'DELETE'},
                            headers: {'x-csrf-token': '{{ csrf_token() }}'},
                            success: function (response) {
                                console.log(response);

                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };

                                if (response.success === true) {
                                    toastr["success"](response.message);

                                    parent.remove();
                                } else if (response.success === false) {
                                    toastr["error"](response.message);
                                }
                            }
                        });
                    }
                }
            });
        }
    </script>
@endpush