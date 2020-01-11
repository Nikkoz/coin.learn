@extends('admin.layout.app')

@section('title', trans('settings.blade.socials.networks.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('settings.blade.socials.networks.list_title') }}
            </h3>

            <div class="card-tools">
                <a class="btn btn-xs btn-success" href="{{ route('admin.settings.social.networks.create') }}">
                    {{ trans('settings.blade.socials.networks.actions.add') }}
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('settings.blade.name') }}</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @foreach($networks as $network)
                    <tr data-entry-id="{{ $network->id }}">
                        <td>{{ ($networks->perPage() * ($networks->currentPage() - 1)) + $loop->iteration }}</td>
                        <td>{{ $network->name }}</td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-info"
                               href="{{ route('admin.settings.social.networks.edit', $network->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.settings.social.networks.destroy', $network->id) }}"
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
                {{ $networks->links() }}
            </div>
        </div>
    </div>
@endsection