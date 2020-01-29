@extends('admin.layout.app')

@section('title', trans('sites.title_all_list'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('sites.title') }}
            </h3>

            <div class="card-tools">
                <a class="btn btn-xs btn-success" href="{{ route('admin.settings.sites.create') }}">
                    {{ trans('global.actions.objects.add', ['object' => 'Site']) }}
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('global.blade.fields.name') }}</th>
                    <th>{{ trans('global.blade.fields.upload') }}</th>
                    <th>{{ trans('global.blade.fields.status') }}</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @foreach($sites as $site)
                    <tr data-entry-id="{{ $site->id }}">
                        <td>{{ ($sites->perPage() * ($sites->currentPage() - 1)) + $loop->iteration }}</td>
                        <td>{{ $site->name }}</td>
                        <td>{{ $site->upload }}</td>
                        <td>
                            <span class="badge {{ $site->status ? 'badge-success' : 'badge-danger' }}">
                                {{ StatusDictionary::getValueByKey($site->status) }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-info"
                               href="{{ route('admin.settings.sites.edit', $site->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.settings.sites.destroy', $site->id) }}"
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
                {{ $sites->links() }}
            </div>
        </div>
    </div>
@endsection