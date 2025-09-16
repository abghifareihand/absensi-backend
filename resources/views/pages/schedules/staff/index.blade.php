@extends('layouts.app')

@section('title', 'Jadwal Staff')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
       <div class="section-header d-flex">
            <h1>Jadwal Staff</h1>
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
                                        <th>Nama Staff</th>
                                        <th>Username</th>
                                        <th>Lihat Jadwal</th>
                                    </tr>
                                    @forelse ($staff as $user)
                                        <tr>
                                            <td>{{ $user->name ?? '-' }}</td>
                                            <td>{{ $user->username ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('schedules.staff.show', $user->id) }}" class="btn btn-info btn-sm">Lihat Jadwal</a>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data tersedia</td>
                                    </tr>
                                    @endforelse
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $staff->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
