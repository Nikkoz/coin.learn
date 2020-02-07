@extends('admin.layout.app')

@section('title', trans('global.blade.title.list.reddit'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('global.blade.title.reddit') }}
            </h3>

            <div class="card-tools">
                <a class="btn btn-xs btn-success" href="{{ route('admin.reddit.create') }}">
                    {{ trans('global.actions.objects.add', ['object' => 'post']) }}
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
                    <th>{{ trans('global.blade.fields.text') }}</th>
                    <th>{{ trans('global.blade.fields.date') }}</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @foreach($posts as $post)
                    <tr data-entry-id="{{ $post->id }}">
                        <td>{{ ($posts->perPage() * ($posts->currentPage() - 1)) + $loop->iteration }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->coin->name }}</td>
                        <td>
                            {{ Str::limit($post->text, 30) }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($post->created)->format('d.m.Y H:i') }}
                        </td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-info" href="{{ route('admin.reddit.edit', $post->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.reddit.destroy', $post->id) }}"
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
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection