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
            <h2 class="section-title">Edit KBLI</h2>
            <div class="card">
                <div class="card-header">
                    <h4>Validasi Edit Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kbli.update', $kbli) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kbli">KBLI</label>
                            <input type="text" class="form-control @error('kbli') is-invalid @enderror" id="kbli"
                                name="kbli" placeholder="Kbli" value="{{ old('kbli', $kbli->kbli) }}" data-id="kbli">
                            @error('kbli')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="judul_kbli">Judul KBLI</label>
                            <input type="text" class="form-control @error('judul_kbli') is-invalid @enderror"
                                id="judul_kbli" name="judul_kbli" placeholder="Judul Kbli"
                                value="{{ old('judul_kbli', $kbli->judul_kbli) }}" data-id="judul_kbli">
                            @error('judul_kbli')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sektor">Sektor</label>
                            <input type="text" class="form-control @error('sektor') is-invalid @enderror" id="sektor"
                                name="sektor" placeholder="Sektor" value="{{ old('sektor', $kbli->sektor) }}"
                                data-id="sektor">
                            @error('sektor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" data-id="submit">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('kbli.index') }}">Cancel</a>
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
