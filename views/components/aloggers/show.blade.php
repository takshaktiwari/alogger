<div class="card ">
    <div class="card-body table-responsive">
        <table class="table mb-0">
            @if($logger->user)
            <tr>
                <td><b>User:</b></td>
                <td>{{ $logger->user->name }}</td>
            </tr>
            @endif
            <tr>
                <td><b>IP:</b></td>
                <td>{{ $logger->ip }}</td>
            </tr>
            <tr>
                <td><b>URL</b></td>
                <td>
                    <span class="d-block" style="overflow-wrap: break-word; word-break: break-all; hyphens: manual;">
                        {{ $logger->url }}
                    </span>
                </td>
            </tr>
            <tr>
                <td><b>Method:</b></td>
                <td>{{ $logger->method }}</td>
            </tr>
            @if($logger->session)
                <tr>
                    <td><b>Session:</b></td>
                    <td>
                        <table class="table mb-0">
                            @foreach($logger->session as $key => $session)
                            <tr>
                                <td><b>{{ $key }}</b></td>
                                <td>
                                    <pre>@php print_r($session) @endphp </pre>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            @endif
            @if($logger->request)
                <tr>
                    <td><b>Request:</b></td>
                    <td>
                        <table class="table mb-0">
                            @foreach($logger->request as $key => $request)
                            <tr>
                                <td><b>{{ $key }}</b></td>
                                <td>
                                    <pre>@php print_r($request) @endphp </pre>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            @endif
            @if($logger->data)
                <tr>
                    <td><b>Data:</b></td>
                    <td>
                        <pre>
                            @php
                                print_r($logger->data)
                            @endphp
                        </pre>
                    </td>
                </tr>
            @endif
            @if($logger->remarks)
                <tr>
                    <td><b>Remarks:</b></td>
                    <td>{{ $logger->remarks }}</td>
                </tr>
            @endif
            <tr>
                <td><b>Created At:</b></td>
                <td>{{ $logger->created_at->format('d-M-Y h:i:s a') }}</td>
            </tr>
        </table>
    </div>
</div>
