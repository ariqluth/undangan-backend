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
            <h2 class="section-title">Tambah Perusahaan</h2>
            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('perusahaan.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input id="nama_perusahaan" name="nama_perusahaan" type="text"
                                class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                placeholder="Nama Perusahaan" value="{{ old('nama_perusahaan') }}"
                                data-id="nama-perusahaan">
                            @error('nama_perusahaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nib">NIB</label>
                            <input id="nib" type="text" class="form-control @error('nib') is-invalid @enderror"
                                name="nib" placeholder="NIB" value="{{ old('nib') }}" data-id="nib">
                            @error('nib')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status_pmdn">Status Penanaman Modal</label>
                            <select class="form-control select2 @error('penanaman_modal_id') is-invalid @enderror"
                                name="penanaman_modal_id" data-id="select-pmdn" id="penanaman_modal_id">
                                <option value="">Pilih Penanaman Modal</option>
                                @foreach ($pemodalans as $pemodalan)
                                    <option value="{{ $pemodalan->id }}">
                                        {{ $pemodalan->status_pmdn }}</option>
                                @endforeach
                            </select>
                            @error('npwp_perusahaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Uraian Jenis Perusahaan</label>
                            <select class="form-control select2 @error('uraian_jenis_perusahaan_id') is-invalid @enderror"
                                name="uraian_jenis_perusahaan_id" data-id="select-uraian-jenis-perusahaan"
                                id="uraian_jenis_perusahaan_id">
                                <option value="">Pilih Uraian Jenis Perusahaan </option>
                                @foreach ($uraianjenisperusahaans as $uraianjenisperusahaan)
                                    <option value="{{ $uraianjenisperusahaan->id }}">
                                        {{ $uraianjenisperusahaan->nama_uraian_jenis_perusahaan }}</option>
                                @endforeach
                            </select>
                            @error('uraian_jenis_perusahaan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Kabupaten</label>
                            <select id="kabupaten_id" name="kabupaten_id"
                                class="form-control select2 @error('kabupaten_id') is-invalid @enderror"
                                data-id="select-kabupaten">
                                <option value="">Pilih Nama Kabupaten</option>
                                @foreach ($kabupatens as $kabupaten)
                                    <option value="{{ $kabupaten->id }}">
                                        {{ $kabupaten->nama_kabupaten }}</option>
                                @endforeach
                            </select>
                            @error('kabupaten_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Perusahaan</label>
                            <input id="alamat" name="alamat" type="text" placeholder="Alamat Usaha"
                                class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}"
                                data-id="alamat-usaha">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="text"
                                class="form-control @error('email') is-invalid @enderror" placeholder="email"
                                value="{{ old('email') }}" data-id="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomer Telpon</label>
                            <input id="no_telp" name="no_telp" type="text"
                                class="form-control @error('no_telp') is-invalid @enderror" placeholder="no_telp"
                                value="{{ old('no_telp') }}" data-id="no_telp">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" data-id="submit-perusahaan">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('perusahaan.index') }}">Cancel</a>
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
