@extends('admin.layout.app')

@section('title', trans('global.blade.title.list.exchanges'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('global.blade.title.exchanges') }}
            </h3>

            <div class="card-tools">
                <a class="btn btn-xs btn-success" href="{{ route('admin.settings.exchanges.create') }}">
                    {{ trans('global.actions.objects.add', ['object' => 'Exchanges']) }}
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('global.blade.fields.name') }}</th>
                    <th>{{ trans('global.blade.fields.network') }}</th>
                    <th>{{ trans('global.blade.fields.status') }}</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @foreach($exchanges as $exchange)
                    <tr data-entry-id="{{ $exchange->id }}">
                        <td>{{ ($exchanges->perPage() * ($exchanges->currentPage() - 1)) + $loop->iteration }}</td>
                        <td>{{ $exchange->name }}</td>
                        <td>{{ $exchange->network->name }}</td>
                        <td>
                            <span class="badge {{ $exchange->status ? 'badge-success' : 'badge-danger' }}">
                                {{ StatusDictionary::getValueByKey($exchange->status) }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-info"
                               href="{{ route('admin.settings.exchanges.edit', $exchange->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.settings.exchanges.destroy', $exchange->id) }}"
                                  method="POST"
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
                {{ $exchanges->links() }}
            </div>
        </div>
    </div>
@endsection