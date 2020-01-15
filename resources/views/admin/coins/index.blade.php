@extends('admin.layout.app')

@section('title', trans('coin.list_title'))

@section('fields')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="inputStatus">Search</label>
                {{ Form::text('q', request('q'), ['placeholder' => 'Search for...', 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="inputStatus">Status</label>
                {{ Form::select('status', ['-1' => trans('global.blade.list.select_one')] + CoinStatusDictionary::getValues(), request('status'), ['class' => 'form-control custom-select']) }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="inputStatus">Type</label>
                {{ Form::select('type', ['-1' => trans('global.blade.list.select_one')] + CoinTypeDictionary::getValues(), request('type'), ['class' => 'form-control custom-select']) }}
            </div>
        </div>

        <div class="col-md-12 text-right">
            <a href="{{ route('admin.coins.index') }}" class="btn btn-default">
                {{ trans('global.blade.reset_filter') }}
            </a>

            <button class="btn btn-success" type="submit">
                <span class="fa fa-search"></span> {{ trans('global.blade.search') }}
            </button>
        </div>
    </div>
@endsection

@section('content')
    @include('admin.layout.partials.filter', ['route' => route('admin.coins.index')])

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('coin.title') }}
            </h3>

            <div class="card-tools">
                <a class="btn btn-xs btn-success" href="{{ route('admin.coins.create') }}">
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
                            <a class="btn btn-sm btn-info"
                               href="{{ route('admin.coins.edit', $coin->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.coins.destroy', $coin->id) }}" method="POST"
                                  onsubmit="return confirm({{ trans('global.blade.sure_delete') }});"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pl-3 pt-3">
                {{ $coins->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection