@extends('layouts.app')

@section('title', 'Detail Company')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="container-fluid">
        <!-- Header -->
        @include('components.card-header', [
            'title' => 'Detail Company',
            'breadcrumbs' => [
                ['text' => 'Home', 'link' => route('home'), 'active' => false],
                ['text' => 'Detail Company', 'link' => '#', 'active' => true],
            ],
        ])
        <div class="card w-100 position-relative overflow-hidden">
            <!-- Title -->
            <div class="px-4 py-3 border-bottom">
                <h5 class="card-title fw-semibold mb-0 lh-sm">Detail Company</h5>
            </div>

            {{-- Form --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <p id="name" class="form-control">{{ $company->name }}</p>

                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <p id="address" class="form-control">{{ $company->address }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <p id="address" class="form-control">{{ $company->email }}</p>

                    </div>
                    <div class="col-md-6">
                        <label for="radius_km" class="form-label">Radius KM</label>
                        <p id="address" class="form-control">{{ $company->radius_km }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="latitude" class="form-label">Latitude</label>
                        <p id="address" class="form-control">{{ $company->latitude }}</p>

                    </div>
                    <div class="col-md-6">
                        <label for="longitude" class="form-label">Longitude</label>
                        <p id="address" class="form-control">{{ $company->longitude }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="time_in" class="form-label">Masuk</label>
                        <p id="address" class="form-control">{{ $company->time_in }}</p>

                    </div>
                    <div class="col-md-6">
                        <label for="time_out" class="form-label">Pulang</label>
                        <p id="address" class="form-control">{{ $company->time_out }}</p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary rounded px-4 mt-2">Edit Company Profile</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
