@extends('layouts.app')

@section('title', 'Users')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
       <div class="section-header d-flex">
            <h1>Data Titik Lokasi</h1>
            <div class="section-header-button ml-auto">
                <a href="{{ route('points.create') }}" class="btn btn-primary">Buat Titik Lokasi</a>
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
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Radius</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                    @foreach ($points as $point)
                                        <td>
                                            {{ $point->name }}
                                        </td>
                                        <td>
                                            {{ $point->latitude }}
                                        </td>
                                        <td>
                                            {{ $point->longitude }}
                                        </td>
                                        <td>
                                            @if ($point->radius < 1000)
                                                {{ $point->radius }} m
                                            @else
                                                {{ number_format($point->radius / 1000, 2) }} km
                                            @endif
                                        </td>

                                       <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('points.edit', $point->id) }}" class="btn btn-sm btn-info btn-icon">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('points.destroy', $point->id) }}" method="POST" class="ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                    <i class="fas fa-times"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach


                                </table>
                            </div>
                            <div class="float-right">
                                {{ $points->withQueryString()->links() }}
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

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
