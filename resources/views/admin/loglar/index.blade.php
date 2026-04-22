@extends('admin.layouts.app')

@section('content')

<h2>System Logs</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Action</th>
            <th>Description</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @foreach($logs as $log)

        @php
            $data = json_decode($log->description, true);
        @endphp

        <tr>
            <td>{{ $log->id }}</td>
            <td>{{ $log->user->name }}</td>
            <td>{{ $log->action }}</td>

            <td>
                @if(is_array($data))
                    <ul>
                        @foreach($data as $key => $value)
                            <li>
    <b>{{ $key }}</b>:
    @if(is_array($value))
        {{ implode(', ', $value) }}
    @else
        {{ $value }}
    @endif
</li>
                        @endforeach
                    </ul>
                @else
                    {{ $log->description }}
                @endif
            </td>

            <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
        </tr>

        @endforeach
    </tbody>
</table>

{{ $logs->links() }}

@endsection