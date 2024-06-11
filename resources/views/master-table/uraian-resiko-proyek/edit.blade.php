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
            <h2 class="section-title">Edit Uraian Resiko Proyek</h2>

            <div class="card">
                <div class="card-header">
                    <h4>Validasi Edit Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('uraian-resiko-proyek.update', $uraian_resiko_proyek) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_uraian_resiko_proyek">Nama Uraian Resiko Proyek</label>
                            <input type="text" class="form-control @error('nama_uraian_resiko_proyek') is-invalid @enderror"
                                id="nama_uraian_resiko_proyek" name="nama_uraian_resiko_proyek" placeholder="Nama Uraian Resiko Proyek"
                                value="{{ old('nama_uraian_resiko_proyek', $uraian_resiko_proyek->nama_uraian_resiko_proyek) }}" data-id="resiko-proyek">
                            @error('nama_uraian_resiko_proyek')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" data-id="submit" >Submit</button>
                    <a class="btn btn-secondary" href="{{ route('uraian-resiko-proyek.index') }}" data-id="cancel">Cancel</a>
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
