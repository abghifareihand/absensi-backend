@extends('layouts.app')

@section('title', 'Attendance Present')

@section('main')
<div class="main-content">
    <section class="section">
       <div class="section-header d-flex">
            <h1>Data Absen</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="clearfix mb-3"></div>
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>User</th>
                                        <th>In Date</th>
                                        <th>Out Date</th>
                                        <th>In Location</th>
                                        <th>Out Location</th>
                                        {{-- <th style="text-align: center;">Action</th> --}}
                                    </tr>
                                    @forelse ($attendances as $attendance)
                                        <tr>
                                            <td>{{ $attendance->user->name }}</td>
                                            <td>
                                                {{ $attendance->check_in_at ? \Carbon\Carbon::parse($attendance->check_in_at)->format('d-m-Y H:i') : '-' }}
                                            </td>
                                            <td>
                                                {{ $attendance->check_out_at ? \Carbon\Carbon::parse($attendance->check_out_at)->format('d-m-Y H:i') : '-' }}
                                            </td>
                                            <td>
                                                @if($attendance->check_in_latitude && $attendance->check_in_longitude)
                                                    {{ $attendance->check_in_latitude }}, {{ $attendance->check_in_longitude }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($attendance->check_out_latitude && $attendance->check_out_longitude)
                                                    {{ $attendance->check_out_latitude }}, {{ $attendance->check_out_longitude }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data tersedia</td>
                                    </tr>
                                    @endforelse
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $attendances->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
