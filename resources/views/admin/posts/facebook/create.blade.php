@extends('admin.layout.app')

@section('title', trans('global.actions.objects.creation', ['object' => 'Post']))

@section('content')
    {!! Form::open(['url' => route('admin.facebook.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    {{ Form::hidden('type', PostTypeDictionary::TYPE_FACEBOOK) }}

    <div class="row">
        <div class="col-5 col-sm-3">
            <div class="card p-2">
                <div class="nav flex-column nav-pills h-100" role="tablist" aria-orientation="vertical">
                    <a href="#main" class="nav-link active" data-toggle="pill" role="tab">
                        {{ trans('global.blade.tabs.post') }}
                    </a>

                    <a href="#user" class="nav-link" data-toggle="pill" role="tab">
                        {{ trans('global.blade.tabs.user') }}
                    </a>

                    <a href="#act" class="nav-link" data-toggle="pill" role="tab">
                        {{ trans('global.blade.tabs.activities') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-7 col-sm-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ trans('global.blade.title.post') }}
                    </h3>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::bsText('global.blade.fields.post_id', 'post_id') }}
                                </div>

                                <div class="col-md-6">
                                    {{ Form::bsSelect('global.blade.fields.coin', 'coin_id', $coins, true) }}
                                </div>

                                <div class="col-md-6">
                                    {{ Form::bsDateTime('global.blade.fields.date', 'created') }}
                                </div>
                            </div>

                            {{ Form::bsTextarea('global.blade.fields.text', 'text') }}
                        </div>

                        <div class="tab-pane" id="user">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::bsText('global.blade.fields.user_id', 'user_id') }}
                                </div>

                                <div class="col-md-6">
                                    {{ Form::bsText('global.blade.fields.user_name', 'user_name') }}
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="act">
                            <div class="row">
                                <div class="col-md-4">
                                    {{ Form::bsText('global.blade.fields.shares', 'shares') }}
                                </div>

                                <div class="col-md-4">
                                    {{ Form::bsText('global.blade.fields.likes', 'likes') }}
                                </div>

                                <div class="col-md-4">
                                    {{ Form::bsText('global.blade.fields.comments', 'comments') }}
                                </div>
                            </div>
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
                    {{ Form::submit(trans('global.actions.objects.save', ['object' => 'post']), ['class' => 'btn btn-success']) }}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@endsection
