@extends('admin.layout.app')

@section('content')
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ trans('global.actions.edit') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="list-group mb-3">
                        <a href="{{ route('admin.coins.edit', $coin->id) }}"
                           class="list-group-item d-flex justify-content-between align-items-center list-group-item-action {{ checkMenuItemActive(route('admin.coins.edit', $coin->id)) }}">
                            <b>{{ trans('coin.blade.general.title') }}</b>
                        </a>

                        <a href="{{ route('admin.links.index', ['coinId' => $coin->id]) }}"
                           class="list-group-item d-flex justify-content-between align-items-center list-group-item-action {{ checkMenuItemActive(route('admin.links.index', ['coinId' => $coin->id])) }}">
                            <b>{{ trans('links.title') }}</b>

                            <span class="badge badge-success badge-pill">
                                {{ $coin->socialLinks->count() }}
                            </span>
                        </a>

                        <a href="{{ route('admin.coins.handbooks.index', ['coinId' => $coin->id]) }}"
                           class="list-group-item d-flex justify-content-between align-items-center list-group-item-action {{ checkMenuItemActive(route('admin.coins.handbooks.index', $coin->id)) }}">
                            <b>{{ trans('handbooks.title') }}</b>

                            <span class="badge badge-success badge-pill">
                                {{ $coin->handbooks->count() }}
                            </span>
                        </a>
                    </div>

                    <div>
                        <a href="{{ route('admin.coins.index') }}" class="btn btn-outline-danger btn-block">
                            {{ trans('global.actions.cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            @yield('inner_content')
        </div>
    </div>
@endsection