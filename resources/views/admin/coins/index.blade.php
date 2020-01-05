@extends('admin.layout.app')

@section('title', trans('coin.list_title'))

@section('content')
    <div class="card {{ request('filter') === null ? 'collapsed-card' : '' }}">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('global.blade.filter') }}
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fas {{ request('filter') === null ? 'fa-plus' : 'fa-minus' }}"></i>
                </button>

                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.coins') }}" method="GET" class="filter">
                <input type="hidden" name="filter" value="1"/>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputStatus">Search</label>
                            <input type="text" class="form-control" name="q" value="{{ request('q') }}"
                                   placeholder="Search for...">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputStatus">Status</label>
                            <select class="form-control custom-select" name="status">
                                <option selected="" disabled="">{{ trans('global.blade.list.select_one') }}</option>
                                @foreach(CoinStatusDictionary::getValues() as $key => $value)
                                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : ''}}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputStatus">Type</label>
                            <select class="form-control custom-select" name="type">
                                <option selected="" disabled="">{{ trans('global.blade.list.select_one') }}</option>
                                @foreach(CoinTypeDictionary::getValues() as $key => $value)
                                    <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : ''}}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <a href="{{ route('admin.coins') }}" class="btn btn-default">
                            {{ trans('global.blade.reset_filter') }}
                        </a>

                        <button class="btn btn-success" type="submit">
                            <span class="fa fa-search"></span> {{ trans('global.blade.search') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('coin.title') }}
            </h3>

            <div class="card-tools">
                <a class="btn btn-xs btn-success" href="{{ route('admin.coins') }}">
                    {{ trans('coin.actions.add') }}
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('coin.blade.name') }}</th>
                    <th>{{ trans('coin.blade.type') }}</th>
                    <th>{{ trans('coin.blade.status') }}</th>
                    <th>{{ trans('coin.blade.date_created') }}</th>
                    <th>{{ trans('coin.blade.date_updated') }}</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @foreach($coins as $coin)
                    <tr data-entry-id="{{ $coin->id }}">
                        <td>{{ ($coins->perPage() * ($coins->currentPage() - 1)) + $loop->iteration }}</td>
                        <td>{{ $coin->name }} ({{ $coin->code }})</td>
                        <td>{{ CoinTypeDictionary::getValueByKey($coin->type) }}</td>
                        <td>
                                <span class="badge {{ $coin->status ? 'badge-success' : 'badge-danger' }}">
                                    {{ CoinStatusDictionary::getValueByKey($coin->status) }}
                                </span>
                        </td>
                        <td>{{ $coin->created_at }}</td>
                        <td>{{ $coin->updated_at }}</td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-primary"
                               href="{{--{{ route('admin.films.show', $film->id) }}--}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-sm btn-info"
                               href="{{--{{ route('admin.films.edit', $film->id) }}--}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{--{{ route('admin.films.destroy', $film->id) }}--}}" method="POST"
                                  onsubmit="return confirm({{ trans('global.blade.sure_delete') }});"
                                  style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pl-3">
                {{ $coins->links() }}
            </div>
        </div>
    </div>
@endsection