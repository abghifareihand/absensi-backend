@extends('layouts.app')

@section('title', 'Attendance Permission')

@section('main')
<div class="main-content">
    <section class="section">
       <div class="section-header d-flex">
            <h1>Data Izin</h1>
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
                                        <th>Alasan</th>
                                        <th>Tanggal</th>
                                        <th>Bukti</th>
                                    </tr>
                                    @forelse ($attendances as $attendance)
                                        <tr>
                                            <td>{{ $attendance->user->name }}</td>
                                            <td>{{ $attendance->reason }}</td>
                                            <td>
                                                @if($attendance->start_date || $attendance->end_date)
                                                    {{ $attendance->start_date ? \Carbon\Carbon::parse($attendance->start_date)->format('d-m-Y') : '-' }}
                                                    @if($attendance->end_date && $attendance->end_date != $attendance->start_date)
                                                        &nbsp;&ndash;&nbsp;{{ \Carbon\Carbon::parse($attendance->end_date)->format('d-m-Y') }}
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td>
                                                @if ($attendance->attachment)
                                                    @php
                                                        $ext = strtolower(pathinfo($attendance->attachment, PATHINFO_EXTENSION));
                                                    @endphp
                                                    @if (in_array($ext, ['jpg','jpeg','png','gif']))
                                                        <a href="{{ asset('storage/' . $attendance->attachment) }}" target="_blank">
                                                            Lihat Foto
                                                        </a>
                                                    @elseif ($ext === 'pdf')
                                                        <a href="{{ asset('storage/' . $attendance->attachment) }}" target="_blank">
                                                            Lihat PDF
                                                        </a>
                                                    @else
                                                        <span class="text-muted">File tidak didukung</span>
                                                    @endif
                                                @else
                                                    <span class="text-muted">Tidak ada file</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data tersedia</td>
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
