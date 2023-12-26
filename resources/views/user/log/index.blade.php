@extends('loginNav')

@section('body')
    <style>
        body {
            overflow: hidden;
        }
    </style>

    <div class="flex h-screen flex-col items-center mt-32">
        <section class="w-4/5 rounded-md bg-gray-100 p-6 shadow-md">
            <h1 class="mb-4 text-2xl font-semibold underline">Logs</h1>

            @php
                $count = $logs->firstItem();
            @endphp

            @if ($count == 0)
                <table class="w-full">
                    <tr>
                        <th>No record found.</th>
                    </tr>
                </table>
            @else
                <table class="w-full">
                    <tr>
                        <th class="text-left h-8">No</th>
                        <th class="text-left">Action Performed</th>
                        <th class="text-left">Performed At</th>
                    </tr>
                    @foreach ($logs as $log)
                        <tr>
                            <td class="h-8">{{ $count }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->created_at }}</td>
                        </tr>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                </table>
            @endif
        </section>
        <div class="flex justify-center mt-4">
            {{ $logs->links() }}
        </div>
    </div>

@endsection
