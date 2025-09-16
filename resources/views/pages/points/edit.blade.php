@extends('layouts.app')

@section('title', 'Edit Titik Lokasi')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Titik Lokasi</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Edit Titik Lokasi</h2>

            <div class="card">
                <form action="{{ route('points.update', $point->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $point->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="number"
                                class="form-control @error('latitude') is-invalid @enderror"
                                name="latitude" value="{{ old('latitude', $point->latitude) }}">
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="number"
                                class="form-control @error('longitude') is-invalid @enderror"
                                name="longitude" value="{{ old('longitude', $point->longitude) }}">
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Radius (m)</label>
                            <input type="number"
                                class="form-control @error('radius') is-invalid @enderror"
                                name="radius" value="{{ old('radius', $point->radius) }}">
                            @error('radius')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('points.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection
