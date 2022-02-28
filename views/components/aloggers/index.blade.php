<div class="card shadow-sm">
    <div action="" class="card-header d-flex flex-wrap justify-content-between">
        <div class="mr-2 me-2 flex-fill d-flex justify-content-between flex-wrap">
            <div class="my-auto">
                Showing
                <b>{{ $loggers->firstItem() }}</b> - <b>{{ $loggers->lastItem() }}</b>
                of
                <b>{{ $loggers->total() }}</b> Items
            </div>
            <div class="my-auto">
                Showing
                <b>{{ $loggers->currentPage() }}</b>
                of <b>{{ $loggers->lastPage() }}</b> Pages
            </div>
        </div>
        <form method="GET" action="" class="flex-fill d-flex justify-content-end">
            <div class="mr-3 me-3">
                <input type="text" class="form-control" name="url" value="{{ $request->get('url') }}"
                    placeholder="Search Url ...">
            </div>
            <div class="mr-3 me-3">
                <input type="text" class="form-control" name="search" value="{{ $request->get('search') }}"
                    placeholder="Search Here ...">
            </div>
            <button type="submit" class="btn btn-dark" name="l_filters" value="1">Search</button>
        </form>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>URL</th>
                    <th>Method</th>
                    <th>User</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loggers as $l_logger)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ url($l_logger->url) }}" target="_blank">
                                <i class="fas fa-external-link-alt fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                            <b class="px-1">|</b>
                            <a href="{{ $filter(['url' => $l_logger->url]) }}">
                                {{ strlen($l_logger->url) > 30 ? substr($l_logger->url, 0, 30) . '...' : $l_logger->url }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ $filter(['method' => $l_logger->method]) }}">
                                {{ $l_logger->method }}
                            </a>
                        </td>
                        <td>
                            <a class="d-block" href="{{ $filter(['user_id' => $l_logger->user_id]) }}">
                                {{ $l_logger->user ? $l_logger->user->name : null }}
                            </a>
                            <a class="d-block" href="{{ $filter(['ip' => $l_logger->ip]) }}">
                                {{ $l_logger->ip }}
                            </a>
                        </td>
                        <td>{{ $l_logger->remarks }}</td>
                        <td class="text-nowrap align-middle">
                            <a href="{{ $filter(['id' => $l_logger->id]) }}" class="btn btn-info btn-sm">
                                <i class="fa-solid fas fa-circle-info"></i> Info
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex justify-content-between">
        {{ $loggers->links() }}

        @if ($request->get('l_filters'))
            <div class="alogger-filter my-auto">
                <a href="{{ $request->url() }}" class="text-danger">
                    <b>X</b> Clear Filter
                </a>
            </div>
        @endif
    </div>
</div>

@if($request->get('id'))
<div class="modal fade" id="logger-show">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Logger Detail</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal">X</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <x-alogger-logger :logger-id="$request->get('id')" />
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="{{ $request->url().'?'.http_build_query($request->except('id')); }}" class="btn btn-danger">Close</a>
            </div>

        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    $(document).ready(function () {
        $("#logger-show").modal('show');
    });
</script>
@endpush
