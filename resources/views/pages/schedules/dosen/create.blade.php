@extends('layouts.app')

@section('title', 'Buat Jadwal ' . $dosen->name)

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
           <h1>Buat Jadwal {{ $dosen->name }}</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Tambah Jadwal</h2>

            <div class="card">
                 <form action="{{ route('schedules.dosen.store', $dosen->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date"
                                name="date"
                                class="form-control @error('date') is-invalid @enderror"
                                value="{{ old('date') }}"
                                required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="time"
                                name="start_time"
                                class="form-control @error('start_time') is-invalid @enderror"
                                value="{{ old('start_time') }}"
                                required>
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <input type="time"
                                name="end_time"
                                class="form-control @error('end_time') is-invalid @enderror"
                                value="{{ old('end_time') }}"
                                required>
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text"
                                name="location"
                                class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location') }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('schedules.dosen.show', $dosen->id) }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection
