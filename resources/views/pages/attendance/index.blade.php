@extends('layouts.app')

@section('title', 'Attendance')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="container-fluid">


        <!-- Alert -->
        @include('layouts.alert')

        <!-- Header -->
        @include('components.card-header', [
            'title' => 'Attendances',
            'breadcrumbs' => [
                ['text' => 'Home', 'link' => route('home'), 'active' => false],
                ['text' => 'Attendance', 'link' => '#', 'active' => true],
            ],
        ])
        <div class="card card-body">
            {{-- Table --}}
            <div class="table-responsive border rounded">
                <table class="table align-middle text-nowrap mb-0">
                    <thead class="text-dark fs-4">
                        <tr class="fw-semibold">
                            <th>Name</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>LatLong In</th>
                            <th>LatLong Out</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="border-top">
                        @foreach ($attendances as $attendance)
                            <tr>
                                <td>
                                    <p class="mb-0 fs-3">{{ $attendance->user->name }}</p> <!-- Akses nama pengguna -->
                                </td>
                                <td>
                                    <p class="mb-0 fs-3">{{ $attendance->date }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 fs-3">{{ $attendance->time_in }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 fs-3">{{ $attendance->time_out }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 fs-3">{{ $attendance->latlong_in }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 fs-3">{{ $attendance->latlong_out }}</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Paginate --}}
            <div class="float-right mt-8">
                {{ $attendances->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
