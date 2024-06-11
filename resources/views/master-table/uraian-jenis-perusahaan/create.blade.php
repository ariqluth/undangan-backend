@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Master Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Tambah Uraian Jenis Perusahaan</h2>

            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('uraian-jenis-perusahaan.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama_uraian_jenis_perusahaan">Nama Uraian Jenis Perusahaan</label>
                            <input type="text" class="form-control @error('nama_uraian_jenis_perusahaan') is-invalid @enderror"
                                id="nama_uraian_jenis_perusahaan" name="nama_uraian_jenis_perusahaan" placeholder="Nama Uraian Jenis Perusahaan"
                                value="{{ old('nama_uraian_jenis_perusahaan') }}" data-id="jenis-perusahaan">
                            @error('nama_uraian_jenis_perusahaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" data-id="submit">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('uraian-jenis-perusahaan.index') }}">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
