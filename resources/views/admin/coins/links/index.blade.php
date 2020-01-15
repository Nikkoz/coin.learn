@extends('admin.coins.menu')

@section('title', trans('coin.links.list_title', ['name' => $coin->name]))

@section('inner_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('coin.links.title') }}
            </h3>

            <div class="card-tools">
                <a class="btn btn-xs btn-success" href="{{ route('admin.links.create', $coin->id) }}">
                    {{ trans('global.actions.objects.add', ['object' => 'link']) }}
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('global.blade.fields.link') }}</th>
                    <th>{{ trans('global.blade.fields.network') }}</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @foreach($links as $link)
                    <tr data-entry-id="{{ $link->id }}">
                        <td>{{ ($links->perPage() * ($links->currentPage() - 1)) + $loop->iteration }}</td>
                        <td>{{ $link->link }}</td>
                        <td>{{ $link->network->name }}</td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-info"
                               href="{{ route('admin.links.edit', ['coinId' => $coin->id, 'id' => $link->id]) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.links.destroy', ['coinId' => $coin->id, 'id' => $link->id]) }}"
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
                {{ $links->links() }}
            </div>
        </div>
    </div>
@endsection