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
            <h2 class="section-title">Edit Profile Pengusaha</h2>

            <div class="card">
                <div class="card-header">
                    <h4>Validasi Edit Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile-pengusaha.update', $profile_pengusaha) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nomor_identitas_user">Nomor Indentitas User</label>
                            <input id="nomor_identitas_user" name="nomor_identitas_user" type="text"
                                class="form-control @error('nomor_identitas_user') is-invalid @enderror"
                                placeholder="Nomor Indentitas User"
                                value="{{ old('nomor_identitas_user', $profile_pengusaha->nomor_identitas_user) }}"
                                data-id="nomor-identitas-pengusaha">
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
                                value="{{ old('nama_pengusaha', $profile_pengusaha->nama_pengusaha) }}"
                                data-id="nama-pengusaha">
                            @error('nama_pengusaha')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Telpon</label>
                            <input id="no_telp" name="no_telp"type="text" placeholder="Nomor Telpon"
                                class="form-control @error('no_telp') is-invalid @enderror" data-id="nomor-telpon"
                                value="{{ old('no_telp', $profile_pengusaha->no_telp) }}">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" placeholder="Email" type="text"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $profile_pengusaha->email) }}" data-id="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" id="button" data-id="submit">Submit</button>
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
