@extends('layouts.app')

@section('title', 'Tambah Titik Lokasi')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Titik Lokasi</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Tambah Titik Lokasi</h2>

            <div class="card">
                <form action="{{ route('points.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="number"
                                step="any"
                                class="form-control @error('latitude') is-invalid @enderror"
                                name="latitude" value="{{ old('latitude') }}">
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="number"
                                step="any"
                                class="form-control @error('longitude') is-invalid @enderror"
                                name="longitude" value="{{ old('longitude') }}">
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Radius (m)</label>
                            <input type="number"
                                class="form-control @error('radius') is-invalid @enderror"
                                name="radius" value="{{ old('radius') }}">
                            @error('radius')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('points.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection
