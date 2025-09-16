@extends('layouts.app')

@section('title', 'Edit Title Aplikasi')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Title Aplikasi</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Edit Title Aplikasi</h2>

            <div class="card">
                <form action="{{ route('settings.update', $setting->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Key</label>
                            <input type="text"
                                class="form-control @error('key') is-invalid @enderror"
                                name="key" value="{{ old('key', $setting->key) }}">
                            @error('key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Value</label>
                            <input type="text"
                                class="form-control @error('value') is-invalid @enderror"
                                name="value" value="{{ old('value', $setting->value) }}">
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('settings.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection
