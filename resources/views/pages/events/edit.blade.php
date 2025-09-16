@extends('layouts.app')

@section('title', 'Edit Event')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Event</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Edit Event</h2>

            <div class="card">
                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title', $event->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date"
                                class="form-control @error('event_date') is-invalid @enderror"
                                name="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}">
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jam</label>
                            <input type="time"
                                class="form-control @error('event_time') is-invalid @enderror"
                                name="event_time" value="{{ old('event_time', $event->event_date->format('H:i')) }}">
                            @error('event_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Photo</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview">
                                    @if($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="img-fluid mb-2 rounded">
                                    @endif
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file"
                                        name="image"
                                        id="image-upload"
                                        class="@error('image') is-invalid @enderror" />
                                </div>
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('events.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
@endpush
