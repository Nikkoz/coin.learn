@section('filter_title', trans('global.blade.filter'))

<div class="card {{ request('filter') === null ? 'collapsed-card' : '' }}">
    <div class="card-header">
        <h3 class="card-title">
            @yield('filter_title')
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
        <form action="{{ $route }}" method="GET" class="filter">
            <input type="hidden" name="filter" value="1"/>

            @yield('fields')
        </form>
    </div>
</div>