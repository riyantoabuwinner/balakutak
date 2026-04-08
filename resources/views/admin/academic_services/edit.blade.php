@extends('adminlte::page')

@section('title', 'Edit Layanan Akademik')

@section('content_header')
    <h1><i class="fas fa-edit mr-2"></i>Edit Layanan Akademik</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-warning card-outline shadow-sm">
                <form action="{{ route('admin.academic-services.update', $academicService) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Layanan <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $academicService->title) }}" required placeholder="Contoh: SIAKAD Mahasiswa">
                            @error('title')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Icon (FontAwesome)</label>
                                <div class="input-group">
                                    <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $academicService->icon) }}" placeholder="fas fa-link">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="{{ $academicService->icon ?: 'fas fa-link' }}"></i></span>
                                    </div>
                                </div>
                                <small class="text-muted">Contoh: <code>fas fa-graduation-cap</code></small>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Urutan Tampil</label>
                                <input type="number" name="order" class="form-control" value="{{ old('order', $academicService->order) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>URL / Tautan Link <span class="text-danger">*</span></label>
                            <input type="url" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $academicService->url) }}" required placeholder="https://siakad.kampus.ac.id">
                            @error('url')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Singkat</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $academicService->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <div class="custom-control custom-switch mt-2">
                                    <input type="checkbox" class="custom-control-input" id="is_external" name="is_external" value="1" {{ old('is_external', $academicService->is_external) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_external">Tautan Eksternal</label>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="custom-control custom-switch mt-2">
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $academicService->is_active) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active">Aktifkan Layanan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('admin.academic-services.index') }}" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-warning px-4 text-white fw-bold">Perbarui Layanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
