@extends('admin.layout.app')

@section('title', trans('handbooks.title_all_list'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('handbooks.title') }}
            </h3>

            <div class="card-tools">
                <a class="btn btn-xs btn-success" href="{{ route('admin.settings.handbooks.create') }}">
                    {{ trans('global.actions.objects.add', ['object' => 'Handbook']) }}
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('global.blade.fields.title') }}</th>
                    <th>{{ trans('global.blade.fields.coin') }}</th>
                    <th class="text-center">{{ trans('global.blade.fields.check_case') }}</th>
                    <th>{{ trans('global.blade.fields.status') }}</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @foreach($handbooks as $handbook)
                    <tr data-entry-id="{{ $handbook->id }}">
                        <td>{{ ($handbooks->perPage() * ($handbooks->currentPage() - 1)) + $loop->iteration }}</td>
                        <td>{{ $handbook->title }}</td>
                        <td>{{ $handbook->coin->name }}</td>
                        <td class="text-center">
                            <i class="fas fa-circle text-{{ $handbook->check_case ? 'success' : 'danger' }}"></i>
                        </td>
                        <td>
                            <span class="badge {{ $handbook->status ? 'badge-success' : 'badge-danger' }}">
                                {{ HandbookStatusDictionary::getValueByKey($handbook->status) }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-info"
                               href="{{ route('admin.settings.handbooks.edit', $handbook->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.settings.handbooks.destroy', $handbook->id) }}"
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
                {{ $handbooks->links() }}
            </div>
        </div>
    </div>
@endsection