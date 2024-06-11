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
            <h2 class="section-title">Tambah Artikel</h2>
            <div class="row">
                <div class="col col-lg-12" id="tambah-artikel">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Box Artikel</h4>
                            <div class="card-header-action">
                                <a href="#fullscreen" id="card-header-action-fullscreen" data-mode="fullscreen"
                                    data-tab="fullscreen" class="btn active">FullScreen</a>
                                <a href="#preview" id="card-header-action-preview" data-mode="preview" data-tab="preview"
                                    class="btn">Preview</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('artikel.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                        id="judul" name="judul" placeholder="judul" value="{{ old('judul') }}"
                                        data-id="judul" autocomplete="off">
                                    @error('judul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="thumbnail">Gambar</label>
                                        <label for="thumbnail" id="image-label">Choose File</label>
                                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                        id="thumbnail" name="thumbnail" placeholder="thumbnail"
                                        value="{{ old('thumbnail') }}" data-id="thumbnail">
                                    @error('thumbnail')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kategori_id">Kategori</label>
                                    <select required="" class="form-control select2" name="kategori_id[]" id="kategori_id"
                                        multiple>
                                        <option>- PILIH KATEGORI -</option>
                                        @foreach ($KategoriArtikel as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="text-dark form-control summernote" value="{{ old('deskripsi') }}"
                                        data-id="deskripsi"></textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" placeholder="Slug" value="{{ old('slug') }}"
                                        data-id="slug" autocomplete="off" readonly>
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" data-id="submit">Submit</button>
                                    <a class="btn btn-secondary" href="{{ route('artikel.index') }}">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-5" id="preview-artikel" style="display:none">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Preview</h4>
                        </div>
                        <div class="card-body">
                            <div class="responsive-container">
                                <div class="container-preview">
                                    <img id="preview-thumbnail" src="#" alt="Gambar Artikel" class="gambar-preview">
                                    <div class="image-overlay"></div>
                                    <h4 id="preview-judul"></h4>
                                </div>
                            </div>
                            <div class="row-borderlis">
                                <div class="row">
                                    <img class="preview-user-profile" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                        alt="">
                                    <div class="col">
                                        <p id="preview-penerbit">Author : </p>
                                        <p id="preview-user">{{ auth()->user()->name }}</p>
                                    </div>
                                    <div class="col">
                                        <p id="preview-penerbit">Berita : </p>
                                        <p id="preview-user">Sekarang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div id="preview-deskripsi" style="padding:10px"></div>
                            </div>
                            <p id="preview-tag">Tag : </p>
                            <div class="row">
                                <p id="preview-kategori"></p>

                            </div>
                        </div>
                    </div>
                </div>
    </section>
@endsection

@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <!-- Initialize Summernote -->
   {{-- <script src="/assets/js/uploadPreview.min.js"></script> --}}
   {{-- <script src="/assets/js/jquery.selectic.min.js"></script> --}}
   {{-- <script src="/assets/js/features-post-create.js"></script> --}}
   {{-- <script src="/assets/js/bootstrap-tagsinput.min.js"></script> --}}
   <script>
        $(document).ready(function() {
            // Fungsi untuk mengubah teks menjadi slug
            function generateSlug(text) {
                return text.toString().toLowerCase()
                    .replace(/\s+/g, '-') // Ganti spasi dengan tanda '-'
                    .replace(/[^\w\-]+/g, '') // Hapus semua karakter non-word
                    .replace(/\-\-+/g, '-') // Ganti multiple '-' dengan single '-'
                    .replace(/^-+/, '') // Hapus '-' dari awal teks
                    .replace(/-+$/, ''); // Hapus '-' dari akhir teks
            }

            // Event listener untuk input nama_kategori
            $('#judul').on('input', function() {
                // Ambil teks dari input nama_kategori
                const namaKategori = $(this).val();

                // Buat slug dari nama_kategori
                const slug = generateSlug(namaKategori);

                // Masukkan slug ke input slug
                $('#slug').val(slug);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#deskripsi').summernote();
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#card-header-action-fullscreen').on('click', function() {
                $('#tambah-artikel').removeClass('col-lg-6').addClass('col-lg-12');
                $('#preview-artikel').css('display', 'none');
                $(this).addClass('active');
                $('#card-header-action-preview').removeClass('active');
            });

            $('#card-header-action-preview').on('click', function() {
                $('#tambah-artikel').removeClass('col-lg-12').addClass('col-lg-6');
                $('#preview-artikel').css('display', 'block');
                $(this).addClass('active');
                $('#card-header-action-fullscreen').removeClass('active');
            });
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-thumbnail').attr('src', e.target.result);
                    $('#preview-thumbnail').css('display', 'block');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {

            $('#deskripsi').summernote();

            $('#judul').on('input', function() {
                $('#preview-judul').text($(this).val());
            });

            $('#thumbnail').on('change', function() {
                readURL(this);
            });

            $('select[name="kategori_id[]"]').on('change', function() {
                var selectedCategories = $('option:selected', this);
                var previewList = '';

                selectedCategories.each(function() {
                    previewList += '<li>' + $(this).text() + '</li>';
                });

                $('#preview-kategori').html('<ul>' + previewList + '</ul>');
            });

            $('#deskripsi').on('summernote.change', function(we, contents, $editable) {
                $('#preview-deskripsi').html(contents);
            });
        });
    </script>
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
