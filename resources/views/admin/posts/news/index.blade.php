@extends('admin.layout.app')

@section('title', trans('global.blade.title.news_list'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('global.blade.title.news') }}
            </h3>

            <div class="card-tools">
                <a class="btn btn-xs btn-success" href="{{ route('admin.news.create') }}">
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
                    <th>{{ trans('global.blade.fields.handbooks') }}</th>
                    <th>{{ trans('global.blade.fields.link') }}</th>
                    <th>{{ trans('global.blade.fields.date') }}</th>
                    <th>{{ trans('global.blade.fields.status') }}</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @foreach($news as $post)
                    <tr data-entry-id="{{ $post->id }}">
                        <td>{{ ($news->perPage() * ($news->currentPage() - 1)) + $loop->iteration }}</td>
                        <td>{{ $post->title }}</td>
                        <td></td>
                        <td>
                            <a href="{{ $post->site->link }}" target="_blank">
                                {{ $post->site->name }}
                            </a>
                        </td>
                        <td>
                            {{ $post->created }}
                        </td>
                        <td>
                            <span class="badge {{ $post->status ? 'badge-success' : 'badge-danger' }}">
                                {{ StatusDictionary::getValueByKey($post->status) }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-info" href="{{ route('admin.news.edit', $post->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.news.destroy', $post->id) }}"
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
                {{ $news->links() }}
            </div>
        </div>
    </div>
@endsection