@extends('admin.layout.app')

@section('title', trans('global.blade.title.formula'))

@section('content')
    {!! Form::open(['url' => route('admin.settings.formula.update', $formula->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

    <div class="row">
        <div class="col-5 col-sm-3">
            <div class="card p-2">
                <div class="nav flex-column nav-pills h-100" role="tablist" aria-orientation="vertical">
                    <a href="#news" class="nav-link active" data-toggle="pill" role="tab">
                        {{ trans('global.blade.tabs.news') }}
                    </a>

                    <a href="#communities" class="nav-link" data-toggle="pill" role="tab">
                        {{ trans('global.blade.tabs.community') }}
                    </a>

                    <a href="#developers" class="nav-link" data-toggle="pill" role="tab">
                        {{ trans('global.blade.tabs.developers') }}
                    </a>

                    <a href="#exchanges" class="nav-link" data-toggle="pill" role="tab">
                        {{ trans('global.blade.tabs.exchanges') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-7 col-sm-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ trans('global.blade.title.formula') }}
                    </h3>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="news">
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::bsText('global.blade.fields.formula_param', 'news_max_val', true, $formula->news_max_val) }}
                                </div>

                                <div class="col-md-12">
                                    {{ Form::bsText('global.blade.fields.formula_news_count', 'news_max_count', true, $formula->news_max_count) }}
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="communities">
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::bsText('global.blade.fields.formula_param', 'community_max_val', true, $formula->community_max_val) }}
                                </div>

                                <div class="col-md-12">
                                    {{ Form::bsText('global.blade.fields.formula_community_count', 'community_max_count', true, $formula->community_max_count) }}
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="developers">
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::bsText('global.blade.fields.formula_param', 'developers_max_val', true, $formula->developers_max_val) }}
                                </div>

                                <div class="col-md-12">
                                    {{ Form::bsText('global.blade.fields.formula_developers_count', 'developers_max_count', true, $formula->developers_max_count) }}
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="exchanges">
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::bsText('global.blade.fields.formula_param', 'exchanges_max_val', true, $formula->exchanges_max_val) }}
                                </div>

                                <div class="col-md-12">
                                    {{ Form::bsText('global.blade.fields.formula_exchanges_count', 'exchanges_max_count', true, $formula->exchanges_max_count) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-footer text-right">
            {{ Form::submit(trans('global.actions.objects.save', ['object' => 'formula']), ['class' => 'btn btn-success']) }}
        </div>
    </div>

    {!! Form::close() !!}
@endsection