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
            <h2 class="section-title">Tambah Kategori</h2>

            <div class="card">
                <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('kategori-artikel.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                            id="nama_kategori" name="nama_kategori" placeholder="Nama Kategori"
                            value="{{ old('nama_kategori') }}" data-id="nama_kategori" autocomplete="off" >
                        @error('nama_kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-secondary" href="{{ route('kategori-artikel.index') }}">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fungsi untuk mengubah teks menjadi slug
            function generateSlug(text) {
                return text.toString().toLowerCase()
                    .replace(/\s+/g, '-')       // Ganti spasi dengan tanda '-'
                    .replace(/[^\w\-]+/g, '')   // Hapus semua karakter non-word
                    .replace(/\-\-+/g, '-')     // Ganti multiple '-' dengan single '-'
                    .replace(/^-+/, '')         // Hapus '-' dari awal teks
                    .replace(/-+$/, '');        // Hapus '-' dari akhir teks
            }

            // Event listener untuk input nama_kategori
            $('#nama_kategori').on('input', function () {
                // Ambil teks dari input nama_kategori
                const namaKategori = $(this).val();

                // Buat slug dari nama_kategori
                const slug = generateSlug(namaKategori);

                // Masukkan slug ke input slug
                $('#slug').val(slug);
            });
        });
    </script>
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
