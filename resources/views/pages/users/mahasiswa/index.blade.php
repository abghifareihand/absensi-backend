@extends('layouts.app')

@section('title', 'Mahasiswa')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
       <div class="section-header d-flex">
            <h1>Data Mahasiswa</h1>
            <div class="section-header-button ml-auto">
                <a href="{{ route('users.mahasiswa.create') }}" class="btn btn-primary">Buat Mahasiswa</a>
            </div>
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
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>No. Identitas</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->name ?? '-' }}</td>
                                            <td>{{ $user->username ?? '-' }}</td>
                                            <td>{{ $user->identity_number ?? '-' }}</td>
                                            <td>{{ $user->email ?? '-' }}</td>
                                            <td>{{ $user->phone ?? '-' }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('users.mahasiswa.edit', $user->id) }}" class="btn btn-sm btn-info btn-icon">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('users.mahasiswa.destroy', $user->id) }}" method="POST" class="ml-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                            <i class="fas fa-times"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data tersedia</td>
                                    </tr>
                                    @endforelse
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $users->withQueryString()->links() }}
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
