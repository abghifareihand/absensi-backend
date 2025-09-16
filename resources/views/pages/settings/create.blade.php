@extends('layouts.app')

@section('title', 'Tambah Title Aplikasi')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Title Aplikasi</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Tambah Title Aplikasi</h2>

            <div class="card">
                <form action="{{ route('settings.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Key</label>
                            <input type="text"
                                class="form-control @error('key') is-invalid @enderror"
                                name="key" value="{{ old('key') }}">
                            @error('key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Value</label>
                            <input type="text"
                                class="form-control @error('value') is-invalid @enderror"
                                name="value" value="{{ old('value') }}">
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('settings.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection
