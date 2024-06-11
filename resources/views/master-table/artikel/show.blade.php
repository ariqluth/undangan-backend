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
            <h2 class="section-title">Show Artikel</h2>
            <div class="row">

                <div class="col col-lg-9" id="preview-artikel">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Preview</h4>
                        </div>
                        <div class="card-body">
                            <div class="responsive-container">
                                <div class="container-preview">
                                    <img id="preview-thumbnail"
                                        src="{{ Storage::url($artikel->path) }}"
                                        alt="{{ $artikel->judul }}" class="gambar-preview">
                                    <h4 id="preview-judul">{{ $artikel->judul }}</h4>
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
                                        <p id="preview-user">{{ $artikel->updated_at }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div id="preview-deskripsi" style="padding:10px">{!! $artikel->deskripsi !!}</div>
                            </div>
                            <p id="preview-tag">Tag : </p>
                            <div class="row">
                                <p id="preview-kategori">
                                    @foreach ($artikel->kategoriArtikel as $kategori)
                                        <span class="kategori-label">{{ $kategori->nama_kategori }}</span>
                                    @endforeach
                                </p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-3" id="berita-sejenis-tags">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Berita Sejenis</h4>
                        </div>
                        <div class="card-body">
                            <div class="show-artikel-luar-container">
                                @foreach ($related_artikels as $key => $art)
                                    <div class="show-artikel-luar">
                                        <ul>
                                            <li>
                                                <div class="image-container">
                                                    <img src="{{ Storage::url($art->path) }}"
                                                        alt="{{ $art->judul }}" class="show-artikel-gambar">
                                                    <div class="background-judul"></div>
                                                    <p class="show-artikel-luar-judul">{{ $art->judul }}</p>
                                                </div>
                                            </li>
                                            <a href="{{ route('artikel.show', $art->id) }}"></a>
                                            <div class="background-news">News
                                            </div>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col col-lg-9" id="random-artikel" style="margin-top:-25px">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Random Artikel</h4>
                        </div>
                        <div class="row">
                            <div class="card-body">
                                <div class="show-random-artikel-container">
                                    @foreach ($artikels as $key => $arts)
                                        <div class="show-random-artikel-luar">
                                            <ul>
                                                <li>
                                                    <img src="{{ Storage::url($arts->path) }}"
                                                        alt="{{ $arts->judul }}" class="show-random-artikel-gambar">
                                                </li>
                                                <a href="{{ route('artikel.show', $arts->id) }}">
                                                    <div class="background-random-judul">
                                                    </div>
                                                </a>

                                                <li>
                                                    <p class="show-random-artikel-luar-judul">{{ $arts->judul }}</p>
                                                </li>
                                                <div class="background-random-news">News
                                                </div>
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
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

    <script>
        $(document).ready(function() {
            $('#deskripsi').summernote();
        });
    </script>

    <script>
        $(window).on('load resize', function() {
            $('.show-random-artikel-gambar').each(function() {
                var $this = $(this);
                var $parent = $this.parent();
                var width = $this.width();
                var height = $this.height();
                $parent.find('.background-random-judul').css({
                    width: width,
                    height: height
                });
            });
        });

        $(window).trigger('resize');
    </script>
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
