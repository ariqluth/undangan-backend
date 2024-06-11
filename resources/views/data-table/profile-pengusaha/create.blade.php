@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Tambah Profile Pengusaha</h2>

            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile-pengusaha.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nomor_identitas_user">Nomor Indentitas User</label>
                            <input id="nomor_identitas_user" name="nomor_identitas_user" type="text"
                                placeholder="Nomor Indentitas User" data-id="nomor-identitas-pengusaha"
                                class="form-control @error('nomor_identitas_user') is-invalid @enderror"
                                value="{{ old('nomor_identitas_user') }}">
                            @error('nomor_identitas_user')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_pengusaha">Nama Profile Pengusaha</label>
                            <input id="nama_pengusaha" name="nama_pengusaha" placeholder="Nama Profile Pengusaha"
                                type="text" class="form-control @error('nama_pengusaha') is-invalid @enderror"
                                value="{{ old('nama_pengusaha') }}" data-id="nama-pengusaha">
                            @error('nama_pengusaha')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Telpon</label>
                            <input id="no_telp" name="no_telp" placeholder="Nomor Telpon" type="text"
                                class="form-control @error('no_telp') is-invalid @enderror"
                                value="{{ old('no_telp') }}" data-id="nomor-telpon">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="text"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                value="{{ old('email') }}" data-id="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" data-id="submit">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('profile-pengusaha.index') }}">Cancel</a>
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
