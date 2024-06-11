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
            <h2 class="section-title">Edit Uraian Skala Usaha</h2>

            <div class="card">
                <div class="card-header">
                    <h4>Validasi Edit Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('uraian-skala-usaha.update', $uraian_skala_usaha) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_uraian_skala_usaha">Nama Uraian Skala Usaha</label>
                            <input type="text" class="form-control @error('nama_uraian_skala_usaha') is-invalid @enderror"
                                id="nama_uraian_skala_usaha" name="nama_uraian_skala_usaha" placeholder="Nama Uraian Skala Usaha"
                                value="{{ old('nama_uraian_skala_usaha', $uraian_skala_usaha->nama_uraian_skala_usaha) }}" data-id="skala-usaha">
                            @error('nama_uraian_skala_usaha')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" data-id="submit" >Submit</button>
                    <a class="btn btn-secondary" href="{{ route('uraian-skala-usaha.index') }}" data-id="cancel">Cancel</a>
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