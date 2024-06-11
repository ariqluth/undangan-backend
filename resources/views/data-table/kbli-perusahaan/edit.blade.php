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
            <h2 class="section-title">Edit Perusahaan</h2>
            <div class="step-wizard">
                <ul class="step-wizard-list">
                    <li class="step-wizard-item current-item" id="site-1">
                        <span class="progress-count">1</span>
                        <span class="progress-label">KBLI Perusahaan</span>
                    </li>
                    <li class="step-wizard-item" id="site-2">
                        <span class="progress-count">2</span>
                        <span class="progress-label">Alamat Usaha</span>
                    </li>
                    <li class="step-wizard-item" id="site-3">
                        <span class="progress-count">3</span>
                        <span class="progress-label">Status Usaha</span>
                    </li>
                    <li class="step-wizard-item" id="site-4">
                        <span class="progress-count">4</span>
                        <span class="progress-label">Total Pembiayaan</span>
                    </li>
                </ul>
            </div>
            <br />
            <div class="card">
                <div class="card-header">
                    <h4 id="titletables">Validasi Edit Data KBLI</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kbli-perusahaan.update', $kbli_perusahaan) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- batas --}}
                        <div id="page-1" class="displapage hilang">
                            <div class="form-group perusahaan-form-group">
                                <label>Nama Perusahaan</label>
                                <select class="form-control select2 @error('perusahaan_id') is-invalid @enderror"
                                    id="perusahaan_id" name="perusahaan_id" data-id="select-nama-perusahaan">
                                    <option value="">Pilih Nama Perusahaan</option>
                                    @foreach ($perusahaans as $perusahaan)
                                        <option @selected($perusahaan->id == $kbli_perusahaan->perusahaan_id) value="{{ $perusahaan->id }}">
                                            {{ $perusahaan->nama_perusahaan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('perusahaan_id')
                                    <div class="invalid-feedback perusahaan-form-group-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback perusahaan-form-group-feedback-js"></div>
                            </div>
                            <div class="form-group kbli-form-group">
                                <label>Kbli</label>
                                <select class="form-control select2 @error('kbli_id') is-invalid @enderror" name="kbli_id"
                                    data-id="select-kbli" id="kbli_id">
                                    <option value="">Pilih Kbli</option>
                                    @foreach ($kblis as $kbli)
                                        <option @selected($kbli->id == $kbli_perusahaan->kbli_id) value="{{ $kbli->id }}">
                                            {{ $kbli->kbli }} - {{ $kbli->judul_kbli }} ( {{ $kbli->sektor }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('kbli_id')
                                    <div class="invalid-feedback kbli-form-group-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback kbli-form-group-feedback-js"></div>
                            </div>
                            <div class="form-group kode-proyek-form-group">
                                <label>Kode Proyek</label>
                                <input type="text" class="form-control @error('kode_proyek') is-invalid @enderror"
                                    id="kode_proyek" name="kode_proyek" placeholder="Kode Proyek"
                                    value="{{ old('kode_proyek', $kbli_perusahaan->kode_proyek) }}" data-id="kode-proyek">
                                @error('kode_proyek')
                                    <div class="invalid-feedback kode-proyek-form-group-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback kode-proyek-form-group-feedback-js"></div>
                            </div>
                            <div class="form-group npwp-form-group">
                                <label>NPWP</label>
                                <input type="text" class="form-control @error('kode_proyek') is-invalid @enderror"
                                    id="npwp" name="npwp" placeholder="Masukan NPWP"
                                    value="{{ old('npwp', $kbli_perusahaan->npwp) }}" data-id="npwp">
                                @error('npwp_id')
                                    <div class="invalid-feedback npwp-form-group-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback npwp-form-group-feedback-js"></div>
                            </div>
                            <div class="card-footer text-right">
                                <a id="next-button-page1" class="btn btn-primary text-light" data-id="next1">Next</a>
                                <a class="btn btn-secondary" href="{{ route('kbli-perusahaan.index') }}">Cancel</a>
                            </div>
                        </div>

                        {{-- batas --}}
                        <div id="page-2" class="displapage">
                            <div class="form-group kecamatan-form-group">
                                <label>Kecamatan</label>
                                <select class="form-control select2 @error('kecamatan_id') is-invalid @enderror"
                                    name="kecamatan_id" data-id="select-kecamatan" id="kecamatan_id">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($kecamatans as $kecamatan)
                                        <option @selected($kecamatan->id == $kbli_perusahaan->kecamatan_id) value="{{ $kecamatan->id }}">
                                            {{ $kecamatan->nama_kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kecamatan_id')
                                    <div class="invalid-feedback kecamatan-form-group-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback kecamatan-form-group-feedback-js"></div>
                            </div>
                            <div class="form-group kelurahan-form-group">
                                <label>Kelurahan</label>
                                <select class="form-control select2 @error('kelurahan_id') is-invalid @enderror"
                                    name="kelurahan_id" data-id="select-kelurahan" id="kelurahan_id">
                                    <option value="">Pilih Kelurahan</option>
                                    <option value=""> </option>
                                </select>
                                @error('kelurahan_id')
                                    <div class="invalid-feedback kelurahan-form-group-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback kelurahan-form-group-feedback-js"></div>
                            </div>
                            <div class="form-group longtitude-form-group">
                                <label>Longtitude</label>
                                <input type="text" class="form-control @error('longtitude') is-invalid @enderror"
                                    id="longtitude" name="longtitude" placeholder="Longtitude"
                                    value="{{ old('longtitude', $kbli_perusahaan->longtitude) }}"
                                    data-id="lg-longtitude">
                                @error('longtitude')
                                    <div class="invalid-feedback longtitude-form-group-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback longtitude-form-group-feedback-js"></div>
                            </div>
                            <div class="form-group latitude-form-group">
                                <label>Latitude</label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                    id="latitude" name="latitude" placeholder="Latitude"
                                    value="{{ old('latitude', $kbli_perusahaan->latitude) }}" data-id="la-latitude">
                                @error('latitude')
                                    <div class="invalid-feedback latitude-form-group-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback latitude-form-group-feedback-js"></div>
                            </div>
                            <div class="form-group alamat-form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat" name="alamat" placeholder="Alamat"
                                    value="{{ old('alamat', $kbli_perusahaan->alamat) }}" data-id="alamat">
                                @error('alamat')
                                    <div class="invalid-feedback alamat-form-group-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback alamat-form-group-feedback-js"></div>
                            </div>
                            <div class="card-footer text-right">
                                <a id="next-button-page2" class="btn btn-primary text-light" data-id="next-2">Next</a>
                                <a id="back-button-page2" class="btn btn-secondary">back</a>
                            </div>
                        </div>

                        {{-- batas --}}
                        <div id="page-3" class="displapage">
                            <div class="form-group profile-pengusaha-form-group">
                                <label>Nama Pengusaha</label>
                                <select class="form-control select2 @error('profile_pengusaha_id') is-invalid @enderror"
                                    name="profile_pengusaha_id" data-id="select-profile-pengusaha"
                                    id="profile_pengusaha_id">
                                    <option value="">Pilih Nama Pengusaha</option>
                                    @foreach ($pengusahans as $pengusahan)
                                        <option @selected($pengusahan->id == $kbli_perusahaan->profile_pengusaha_id) value="{{ $pengusahan->id }}">
                                            {{ $pengusahan->nama_pengusaha }}</option>
                                    @endforeach
                                </select>
                                @error('profile_pengusaha_id')
                                    <div class="invalid-feedback profile-pengusaha-form-group-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback profile-pengusaha-form-group-feedback-js"></div>
                            </div>
                            <div class="form-group uraian-resiko-proyek-form-group">
                                <label>Uraian Resiko Proyek</label>
                                <select
                                    class="form-control select2 @error('uraian_resiko_proyek_id') is-invalid @enderror"
                                    name="uraian_resiko_proyek_id" data-id="select-uraian-resiko-proyek"
                                    id="uraian_resiko_proyek_id">
                                    <option value="">Pilih Uraian Resiko Proyek</option>
                                    @foreach ($uraianresikoproyeks as $uraianresikoproyek)
                                        <option @selected($uraianresikoproyek->id == $kbli_perusahaan->uraian_resiko_proyek_id) value="{{ $uraianresikoproyek->id }}">
                                            {{ $uraianresikoproyek->nama_uraian_resiko_proyek }}</option>
                                    @endforeach
                                </select>
                                @error('uraian_resiko_proyek_id')
                                    <div class="invalid-feedback uraian-resiko-proyek-form-group-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback uraian-resiko-proyek-form-group-feedback-js"></div>
                            </div>
                            <div class="form-group uraian-skala-usaha-form-group">
                                <label>Uraian Skala Usaha</label>
                                <select class="form-control select2 @error('uraian_skala_usaha_id') is-invalid @enderror"
                                    name="uraian_skala_usaha_id" data-id="select-uraian-skala-usaha"
                                    id="uraian_skala_usaha_id">
                                    <option value="">Pilih Uraian Skala Usaha</option>
                                    @foreach ($uraianskalausaha as $uraianskalausaha)
                                        <option @selected($uraianskalausaha->id == $kbli_perusahaan->uraian_skala_usaha_id) value="{{ $uraianskalausaha->id }}">
                                            {{ $uraianskalausaha->nama_uraian_skala_usaha }}</option>
                                    @endforeach
                                </select>
                                @error('uraian_skala_usaha_id')
                                    <div class="invalid-feedback uraian-skala-usaha-form-group-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback uraian-skala-usaha-form-group-feedback-js"></div>
                            </div>
                            <div class="form-group gambar-form-group">
                                <label>Gambar Utama</label>
                                <input type="file"
                                    class="form-control file @error('gambar_utama') is-invalid @enderror"
                                    id="gambar_utama" name="gambar_utama" data-id="gambar_utama"
                                    onchange="return validasiEkstensi()">
                                @error('gambar_utama')
                                    <div class="invalid-feedback gambar-form-group-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback gambar-form-group-feedback-js"></div>
                            </div>
                            <div class="form-group gambar-form-group">
                                <label>Gambar Sampingan</label>
                                <input type="file"
                                    class="form-control file @error('gambar_sampingan') is-invalid @enderror"
                                    id="gambar_sampingan" name="gambar_sampingan" data-id="gambar_sampingan"
                                    onchange="return validasiEkstensi()">
                                @error('gambar_sampingan')
                                    <div class="invalid-feedback gambar-form-group-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback gambar-form-group-feedback-js"></div>
                            </div>
                            <div id="preview"></div>
                            {{-- <div class="form-group gambar-form-group">
                                <label>Gambar</label>
                                <div class="dropzone dz-clickable" id="mydropzone">
                                    <div class="dz-default dz-message">
                                        <span>Drop files here or click to upload</span>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="card-footer text-right">
                                <a id="next-button-page3" class="btn btn-primary text-light" data-id="next-3">Next</a>
                                <a id="back-button-page3" class="btn btn-secondary">Back</a>
                            </div>
                        </div>

                        {{-- batas --}}
                        <div id="page-4" class="displapage">
                            <div class="form-group">
                                <label>Mesin Peralatan</label>
                                <input type="text" class="form-control @error('mesin_peralatan') is-invalid @enderror"
                                    id="mesin_peralatan" name="mesin_peralatan" placeholder="mesin_peralatan"
                                    value="{{ old('mesin_peralatan', $kbli_perusahaan->mesin_peralatan) }}"
                                    data-id="mesin-peralatan">
                                @error('mesin_peralatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mesin Peralatan Impor</label>
                                <input type="text"
                                    class="form-control @error('mesin_peralatan_impor') is-invalid @enderror"
                                    id="mesin_peralatan_impor" name="mesin_peralatan_impor"
                                    placeholder="mesin_peralatan_impor"
                                    value="{{ old('mesin_peralatan_impor', $kbli_perusahaan->mesin_peralatan_impor) }}"
                                    data-id="mesin-peralatan-impor">
                                @error('mesin_peralatan_impor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Pembelian Pematangan Tanah</label>
                                <input type="text"
                                    class="form-control @error('pembelian_pematangan_tanah') is-invalid @enderror"
                                    id="pembelian_pematangan_tanah" name="pembelian_pematangan_tanah"
                                    placeholder="pembelian_pematangan_tanah"
                                    value="{{ old('pembelian_pematangan_tanah', $kbli_perusahaan->pembelian_pematangan_tanah) }}"
                                    data-id="pembelian-pematangan-tanah">
                                @error('pembelian_pematangan_tanah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Bangunan Gedung</label>
                                <input type="text" class="form-control @error('bangunan_gedung') is-invalid @enderror"
                                    id="bangunan_gedung" name="bangunan_gedung" placeholder="bangunan_gedung"
                                    value="{{ old('bangunan_gedung', $kbli_perusahaan->bangunan_gedung) }}"
                                    data-id="bangunan-gedung">
                                @error('bangunan_gedung')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Lain Lain</label>
                                <input type="text" class="form-control @error('lain_lain') is-invalid @enderror"
                                    id="lain_lain" name="lain_lain" placeholder="lain_lain"
                                    value="{{ old('lain_lain', $kbli_perusahaan->lain_lain) }}" data-id="lain-lain">
                                @error('lain_lain')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Modal Kerja</label>
                                <input type="text" class="form-control @error('modal_kerja') is-invalid @enderror"
                                    id="modal_kerja" name="modal_kerja" placeholder="modal_kerja"
                                    value="{{ old('modal_kerja', $kbli_perusahaan->modal_kerja) }}"
                                    data-id="modal-kerja">
                                @error('modal_kerja')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jumlah investasi</label>
                                <input type="text"
                                    class="form-control @error('jumlah_investasi') is-invalid @enderror"
                                    id="jumlah_investasi" name="jumlah_investasi" placeholder="Jumlah Investasi"
                                    value="{{ old('jumlah_investasi', $kbli_perusahaan->jumlah_investasi) }}"
                                    data-id="jumlah-investasi">
                                @error('jumlah_investasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tenaga kerja</label>
                                <input type="text" class="form-control @error('tenaga_kerja') is-invalid @enderror"
                                    id="tenaga_kerja" name="tenaga_kerja" placeholder="Kode Proyek"
                                    value="{{ old('tenaga_kerja', $kbli_perusahaan->tenaga_kerja) }}"
                                    data-id="tenaga-kerja">
                                @error('tenaga_kerja')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="card-footer text-right">
                                <button id="button" class="btn btn-primary" data-id="submit">Submit</button>
                                <a id="back-button-page4" class="btn btn-secondary">back</a>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            $('#kecamatan_id').change(function() {
                var kecamatanId = this.value;
                $('#kelurahan_id').html('<option value="">Pilih Nama Kelurahan</option>');
                if ($(this).val() == '') {
                    $('#kelurahan_id').attr('disabled', true);
                } else {
                    $('#kelurahan_id').removeAttr('disabled', false);
                }
                $.ajax({
                    url: '{{ route('kelurahanstore.filter') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        kecamatan_id: kecamatanId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var kelurahanDropdown = $('#kelurahan_id');
                        kelurahanDropdown.empty();
                        kelurahanDropdown.html(
                            '<option value="">Pilih Nama Kelurahan</option>');
                        $.each(response['Kelurahan'], function(index, val) {
                            console.log('<option value="' + kecamatanId + '"> ' + val
                                .nama_kelurahan + ' </option>');
                            kelurahanDropdown.append('<option value="' + val.id +
                                '"> ' + val
                                .nama_kelurahan + ' </option>')
                        });
                    }
                });
            });
            var selectkecPerusahaan = ({{ $kbli_perusahaan->kecamatan_id }});
            var selectkelId = "{{ $kbli_perusahaan->kelurahan->id }}";
            var selectkelSe = "{{ $kelurahans }}"
            var dataKelurahan = JSON.parse(selectkelSe.replace(/&quot;/g, '"'));
            $('#kelurahan_id').empty();
            $.ajax({
                url: '{{ route('load.filter') }}',
                type: 'get',
                dataType: 'json',
                data: {
                    kecamatan_id: selectkecPerusahaan
                },
                success: function(response, items) {
                    $.each(dataKelurahan, function(index, val) {
                        // console.log(selectkelId);

                        if (val.kecamatan_id == selectkecPerusahaan) {
                            console.log('<option value="' + val.id + '" >' +
                                val.nama_kelurahan + '</option>')
                            $('#kelurahan_id').append('<option value="' + val.id + '" >' +
                                val.nama_kelurahan + '</option>')
                            $("#kelurahan_id option[value='" + selectkelId + "']").attr(
                                "selected", "selected");
                        }
                    });
                }
            });
            $('#kbli_id').change(function() {
                var kbli_id = jQuery(this).val();
                var judul_kbli_id = jQuery(this).val();
                var selectSektor = "{{ $kblis }}";
                var dataSektor = JSON.parse(selectSektor.replace(/&quot;/g, '"'));
                $('#judul_kbli_id').empty();
                $('#sektor').empty();
                $.ajax({
                    url: '{{ route('kbli.filter') }}',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id: kbli_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        var judulKbliDropdown = $('#judul_kbli_id');
                        judulKbliDropdown.empty();
                        var sektorDropdown = $('#sektor_id');
                        sektorDropdown.empty();
                        $.each(dataSektor, function(index, val) {
                            judulKbliDropdown.append('<option value="' + val.id +
                                '"> ' + val
                                .judul_kbli + ' </option>')
                            $("#judul_kbli_id option[value='" + kbli_id + "']").attr(
                                "selected", "selected");

                        });
                        $.each(dataSektor, function(index, val) {
                            sektorDropdown.append('<option value="' + val.id + '"> ' +
                                val
                                .sektor + ' </option>');
                            $("#sektor_id option[value='" + kbli_id + "']").attr(
                                "selected", "selected");
                        });

                    }
                });
            });

            var selectSektor = "{{ $kblis }}";
            var dataSektor = JSON.parse(selectSektor.replace(/&quot;/g, '"'));
            var selectedJudul = ({{ $kbli_perusahaan->kbli_id }});
            var sektorId = "{{ $kbli_perusahaan->sektor_id }}";
            var judulId = "{{ $kbli_perusahaan->judul_kbli_id }}";
            $.ajax({
                url: '{{ route('edit.filter') }}',
                type: 'get',
                data: {
                    id: selectedJudul
                },
                success: function(data) {
                    var judulKbliDropdown = $('#judul_kbli_id');
                    judulKbliDropdown.empty();
                    var sektorDropdown = $('#sektor_id');
                    sektorDropdown.empty();
                    $.each(dataSektor, function(index, val) {
                        if (val.id == selectedJudul) {
                            $("#judul_kbli_id option[value='" + val.id + "']").attr(
                                "selected", "selected");
                            judulKbliDropdown.html('<option value="' + judulId + '"> ' + val
                                .judul_kbli + ' </option>')
                        }
                    });
                    $.each(dataSektor, function(index, val) {
                        if (val.id == selectedJudul) {
                            $("#sektor_id option[value='" + val.id + "']").attr(
                                "selected", "selected");
                            sektorDropdown.html('<option value="' + sektorId + '"> ' + val
                                .sektor + ' </option>');
                        }
                    });
                }
            });

        });
    </script>
    <script>
        // gambar
        // function validasiEkstensi() {
        //     var inputFile = document.getElementById('gambar');
        //     var pathFile = inputFile.value;
        //     var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        //     if (!ekstensiOk.exec(pathFile)) {
        //         alert('Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png/.gif');
        //         inputFile.value = '';
        //         return false;
        //     } else {
        //         var files = document.getElementById('gambar').files;
        //         for (var i = 0; i < files.length; i++) {
        //             if (inputFile.files && inputFile.files[i]) {
        //                 var reader = new FileReader();
        //                 reader.onload = function(e) {
        //                     // var files = document.getElementById('gambar').files;
        //                     // document.getElementById('preview').innerHTML = '<img src="' + e.target.result +
        //                     // '" style="height:300px"/>';
        //                     var preview = document.getElementById('preview');
        //                     // for (var i = 0; i < files.length; i++) {
        //                     var img = document.createElement('img');
        //                     img.src = e.target.result;
        //                     img.style.height = '100px';
        //                     preview.appendChild(img);
        //                     // }
        //                 };
        //                 reader.readAsDataURL(inputFile.files[i]);
        //             }
        //         }

        //     }
        // }
        // function validasiEkstensi() {
        //     var inputFile = document.getElementById('gambar');
        //     var pathFile = inputFile.value;
        //     var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        //     if (!ekstensiOk.exec(pathFile)) {
        //         alert('Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png/.gif');
        //         inputFile.value = '';
        //         return false;
        //     } else {
        //         var files = document.getElementById('gambar').files;
        //         var preview = document.getElementById('preview');
        //         preview.innerHTML = '';
        //         for (var i = 0; i < files.length; i++) {
        //             if (inputFile.files && inputFile.files[i]) {
        //                 var reader = new FileReader();
        //                 reader.onload = (function(file) {
        //                     return function(e) {
        //                         var img = document.createElement('img');
        //                         img.src = e.target.result;
        //                         img.style.height = '100px';
        //                         preview.appendChild(img);
        //                         var removeButton = document.createElement('button');
        //                         removeButton.innerHTML = 'Remove';
        //                         removeButton.onclick = function() {
        //                             img.remove();
        //                             removeButton.remove();
        //                         };
        //                         preview.appendChild(removeButton);
        //                     };
        //                 })(inputFile.files[i]);
        //                 reader.readAsDataURL(inputFile.files[i]);
        //             }
        //         }
        //     }
        // }


        function validasiEkstensi() {
            var inputFile = document.getElementById('gambar');
            var pathFile = inputFile.value;
            var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!ekstensiOk.exec(pathFile)) {
                alert('Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png/.gif');
                inputFile.value = '';
                return false;
            } else {
                var files = document.getElementById('gambar').files;
                var preview = document.getElementById('preview');
                preview.innerHTML = '';
                preview.classList.add('preview-with-border'); // Add the class to apply border style

                for (var i = 0; i < files.length; i++) {
                    if (inputFile.files && inputFile.files[i]) {
                        var reader = new FileReader();

                        reader.onload = (function(file) {
                            return function(e) {
                                var img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.height = '100px';
                                preview.appendChild(img);

                                var removeButton = document.createElement('button');
                                removeButton.innerHTML = 'Remove';
                                removeButton.onclick = function() {
                                    img.remove();
                                    removeButton.remove();
                                };
                                removeButton.classList.add('custom-button-class');

                                preview.appendChild(removeButton);
                            };
                        })(inputFile.files[i]);

                        reader.readAsDataURL(inputFile.files[i]);
                    }
                }
            }
        }


        function removeFileFromList(files, index) {
            var newFiles = [];
            for (var i = 0; i < files.length; i++) {
                if (i !== index) {
                    newFiles.push(files[i]);
                }
            }
            return newFiles;
        }






        // Get all the necessary elements
        const page1 = document.getElementById('page-1');
        const page2 = document.getElementById('page-2');
        const page3 = document.getElementById('page-3');
        const page4 = document.getElementById('page-4');
        const backButton1 = document.getElementById('back-button-page1');
        const backButton2 = document.getElementById('back-button-page2');
        const backButton3 = document.getElementById('back-button-page3');
        const backButton4 = document.getElementById('back-button-page4');
        const nextButton1 = document.getElementById('next-button-page1');
        const nextButton2 = document.getElementById('next-button-page2');
        const nextButton3 = document.getElementById('next-button-page3');
        const nextButton4 = document.getElementById('next-button-page4');

        document.addEventListener('DOMContentLoaded', function() {
            function validatePage1() {
                let perusahaanId = document.getElementById('perusahaan_id').value;
                let kbliId = document.getElementById('kbli_id').value;
                let kodeProyek = document.getElementById('kode_proyek').value;
                let npwpId = document.getElementById('npwp').value;
                let isValid = true;
                let errorMessages = [];


                if (perusahaanId.trim() === '') {
                    isValid = false;
                    document.getElementById('perusahaan_id').classList.add('is-invalid');
                    errorMessages.push('Perusahaan Wajib Diisi');
                    let perusahaanFeedback = document.querySelector('.perusahaan-form-group .invalid-feedback');
                    if (perusahaanFeedback) {
                        perusahaanFeedback.textContent = 'Perusahaan Wajib Diisi';
                    }
                    let perusahaanFeedbackJS = document.querySelector(
                        '.perusahaan-form-group .invalid-feedback-js');
                    if (perusahaanFeedbackJS) {
                        perusahaanFeedbackJS.textContent = 'Perusahaan Wajib Diisi';
                    }
                } else {
                    document.getElementById('perusahaan_id').classList.remove('is-invalid');
                    let perusahaanFeedback = document.querySelector('.perusahaan-form-group .invalid-feedback');
                    if (perusahaanFeedback) {
                        perusahaanFeedback.textContent = '';
                    }
                    let perusahaanFeedbackJS = document.querySelector(
                        '.perusahaan-form-group .invalid-feedback-js');
                    if (perusahaanFeedbackJS) {
                        perusahaanFeedbackJS.textContent = '';
                    }
                }

                if (kbliId.trim() === '') {
                    isValid = false;
                    document.getElementById('kbli_id').classList.add('is-invalid');
                    errorMessages.push('KBLI ID is required');
                    let kbliFeedback = document.querySelector('.kbli-form-group .invalid-feedback');
                    if (kbliFeedback) {
                        kbliFeedback.textContent = 'KBLI Wajib diisi';
                    }
                    let kbliFeedbackJS = document.querySelector(
                        '.kbli-form-group .invalid-feedback-js');
                    if (kbliFeedbackJS) {
                        kbliFeedbackJS.textContent = 'KBLI Wajib diisi';
                    }
                } else {
                    document.getElementById('kbli_id').classList.remove('is-invalid');
                    let kbliFeedback = document.querySelector('.kbli-form-group .invalid-feedback');
                    if (kbliFeedback) {
                        kbliFeedback.textContent = '';
                    }
                    let kbliFeedbackJS = document.querySelector(
                        '.kbli-form-group .invalid-feedback-js');
                    if (kbliFeedbackJS) {
                        kbliFeedbackJS.textContent = '';
                    }
                }

                if (kodeProyek.trim() === '') {
                    isValid = false;
                    document.getElementById('kode_proyek').classList.add('is-invalid');
                    errorMessages.push('Kelurahan Wajib Diisi');
                    let kodeProyekFeedback = document.querySelector('.kode-proyek-form-group .invalid-feedback');
                    if (kodeProyekFeedback) {
                        kodeProyekFeedback.textContent = 'Kode Proyek Wajib diisi';
                    }
                    let kodeProyekFeedbackJS = document.querySelector(
                        '.kode-proyek-form-group .invalid-feedback-js');
                    if (kodeProyekFeedbackJS) {
                        kodeProyekFeedbackJS.textContent = 'Kode Proyek Wajib diisi';
                    }
                } else if (kodeProyek.trim().length < 3 || kodeProyek.trim().length > 60) {
                    isValid = false;
                    document.getElementById('kode_proyek').classList.add('is-invalid');
                    errorMessages.push('Kode Proyek must be between 3 and 60 characters');
                    let kodeProyekFeedback = document.querySelector('.kode-proyek-form-group .invalid-feedback');
                    if (kodeProyekFeedback) {
                        kodeProyekFeedback.textContent = 'Kode Proyek must be between 3 and 60 characters';
                    }
                    let kodeProyekFeedbackJS = document.querySelector(
                        '.kode-proyek-form-group .invalid-feedback-js');
                    if (kodeProyekFeedbackJS) {
                        kodeProyekFeedbackJS.textContent = 'Kode Proyek must be between 3 and 60 characters';
                    }
                } else {
                    document.getElementById('kode_proyek').classList.remove('is-invalid');
                    let kodeProyekFeedback = document.querySelector('.kode-proyek-form-group .invalid-feedback');
                    if (kodeProyekFeedback) {
                        kodeProyekFeedback.textContent = '';
                    }
                    let kodeProyekFeedbackJS = document.querySelector(
                        '.kode-proyek-form-group .invalid-feedback-js');
                    if (kodeProyekFeedbackJS) {
                        kodeProyekFeedbackJS.textContent = '';
                    }
                }


                if (isNaN(npwpId)) {
                    isValid = false;
                    document.getElementById('npwp').classList.add('is-invalid');
                    errorMessages.push('NPWP wajib angka');
                    let npwpFeedback = document.querySelector(
                        '.npwp-form-group .invalid-feedback');
                    if (npwpFeedback) {
                        npwpFeedback.textContent = 'NPWP wajib angka';
                    }
                    let npwpFeedbackJS = document.querySelector(
                        '.npwp-form-group .invalid-feedback-js');
                    if (npwpFeedbackJS) {
                        npwpFeedbackJS.textContent = 'NPWP wajib angka';
                    }
                } else {
                    document.getElementById('npwp').classList.remove('is-invalid');
                    let npwpFeedback = document.querySelector('.npwp-form-group .invalid-feedback');
                    if (npwpFeedback) {
                        npwpFeedback.textContent = '';
                    }
                    let npwpFeedbackJS = document.querySelector(
                        '.npwp-form-group .invalid-feedback-js');
                    if (npwpFeedbackJS) {
                        npwpFeedbackJS.textContent = '';
                    }
                }

                return isValid;

            }

            function validatePage2() {
                let kecamatanId = document.getElementById('kecamatan_id').value;
                let kelurahanId = document.getElementById('kelurahan_id').value;
                let longtitude = document.getElementById('longtitude').value;
                let latitude = document.getElementById('latitude').value;
                let alamat = document.getElementById('alamat').value;
                let isValid = true;
                let errorMessages = [];


                if (kecamatanId.trim() === '') {
                    isValid = false;
                    document.getElementById('kecamatan_id').classList.add('is-invalid');
                    errorMessages.push('KBLI ID is required');
                    let kecamatanFeedback = document.querySelector('.kecamatan-form-group .invalid-feedback');
                    if (kecamatanFeedback) {
                        kecamatanFeedback.textContent = 'Kecamatan Wajib diisi';
                    }
                    let kecamatanFeedbackJS = document.querySelector(
                        '.kecamatan-form-group .invalid-feedback-js');
                    if (kecamatanFeedbackJS) {
                        kecamatanFeedbackJS.textContent = 'Kecamatan Wajib diisi';
                    }
                } else {
                    document.getElementById('kecamatan_id').classList.remove('is-invalid');
                    let kecamatanFeedback = document.querySelector('.kecamatan-form-group .invalid-feedback');
                    if (kecamatanFeedback) {
                        kecamatanFeedback.textContent = '';
                    }
                    let kecamatanFeedbackJS = document.querySelector(
                        '.kecamatan-form-group .invalid-feedback-js');
                    if (kecamatanFeedbackJS) {
                        kecamatanFeedbackJS.textContent = '';
                    }
                }

                if (kelurahanId.trim() === '') {
                    isValid = false;
                    document.getElementById('kelurahan_id').classList.add('is-invalid');
                    errorMessages.push('Kelurahan Wajib Diisi');
                    let kelurahanFeedback = document.querySelector('.kelurahan-form-group .invalid-feedback');
                    if (kelurahanFeedback) {
                        kelurahanFeedback.textContent = 'Kelurahan Wajib Diisi';
                    }
                    let kelurahanFeedbackJS = document.querySelector(
                        '.kelurahan-form-group .invalid-feedback-js');
                    if (kelurahanFeedbackJS) {
                        kelurahanFeedbackJS.textContent = 'Kelurahan Wajib Diisi';
                    }
                } else {
                    document.getElementById('kelurahan_id').classList.remove('is-invalid');
                    let kelurahanFeedback = document.querySelector('.kelurahan-form-group .invalid-feedback');
                    if (kelurahanFeedback) {
                        kelurahanFeedback.textContent = '';
                    }
                    let kelurahanFeedbackJS = document.querySelector(
                        '.kelurahan-form-group .invalid-feedback-js');
                    if (kelurahanFeedbackJS) {
                        kelurahanFeedbackJS.textContent = '';
                    }
                }

                if (isNaN(longtitude)) {
                    isValid = false;
                    document.getElementById('longtitude').classList.add('is-invalid');
                    errorMessages.push('longtitude wajib angka');
                    let longtitudeTanahFeedback = document.querySelector(
                        '.longtitude-form-group .invalid-feedback');
                    if (longtitudeTanahFeedback) {
                        longtitudeTanahFeedback.textContent = 'Longtitude wajib angka';
                    }
                    let longtitudeTanahFeedbackJS = document.querySelector(
                        '.longtitude-form-group .invalid-feedback-js');
                    if (longtitudeTanahFeedbackJS) {
                        longtitudeTanahFeedbackJS.textContent = 'Longtitude wajib angka';
                    }
                } else {
                    document.getElementById('longtitude').classList.remove('is-invalid');
                    let longtitudeFeedback = document.querySelector('.longtitude-form-group .invalid-feedback');
                    if (longtitudeFeedback) {
                        longtitudeFeedback.textContent = '';
                    }
                    let longtitudeFeedbackJS = document.querySelector(
                        '.longtitude-form-group .invalid-feedback-js');
                    if (longtitudeFeedbackJS) {
                        longtitudeFeedbackJS.textContent = '';
                    }
                }

                if (isNaN(latitude)) {
                    isValid = false;
                    document.getElementById('latitude').classList.add('is-invalid');
                    errorMessages.push('latitude wajib angka');
                    let latitudeFeedback = document.querySelector(
                        '.latitude-form-group .invalid-feedback');
                    if (latitudeFeedback) {
                        latitudeFeedback.textContent = 'latitude wajib angka';
                    }
                    let latitudeFeedbackJS = document.querySelector(
                        '.latitude-form-group .invalid-feedback-js');
                    if (latitudeFeedbackJS) {
                        latitudeFeedbackJS.textContent = 'Longtitude wajib angka';
                    }
                } else {
                    document.getElementById('latitude').classList.remove('is-invalid');
                    let latitudeFeedback = document.querySelector('.latitude-form-group .invalid-feedback');
                    if (latitudeFeedback) {
                        latitudeFeedback.textContent = '';
                    }
                    let latitudeFeedbackJS = document.querySelector(
                        '.latitude-form-group .invalid-feedback-js');
                    if (latitudeFeedbackJS) {
                        latitudeFeedbackJS.textContent = '';
                    }
                }

                if (alamat.trim() === '') {
                    isValid = false;
                    document.getElementById('alamat').classList.add('is-invalid');
                    errorMessages.push('Alamat Wajib Diisi');
                    let alamatFeedback = document.querySelector('.alamat-form-group .invalid-feedback');
                    if (alamatFeedback) {
                        alamatFeedback.textContent = 'Alamat Wajib Diisi';
                    }
                    let alamatFeedbackJS = document.querySelector(
                        '.alamat-form-group .invalid-feedback-js');
                    if (alamatFeedbackJS) {
                        alamatFeedbackJS.textContent = 'Alamat Wajib Diisi';
                    }
                } else {
                    document.getElementById('alamat').classList.remove('is-invalid');
                    let alamatFeedback = document.querySelector('.alamat-form-group .invalid-feedback');
                    if (alamatFeedback) {
                        alamatFeedback.textContent = '';
                    }
                    let alamatFeedbackJS = document.querySelector(
                        '.alamat-form-group .invalid-feedback-js');
                    if (alamatFeedbackJS) {
                        alamatFeedbackJS.textContent = '';
                    }
                }
                return isValid;
            }


            function validatePage3() {
                let profilepengusahaId = document.getElementById('profile_pengusaha_id').value;
                let uraianresikoproyekId = document.getElementById('uraian_resiko_proyek_id').value;
                let uraianskalausahaId = document.getElementById('uraian_skala_usaha_id').value;
                let isValid = true;
                let errorMessages = [];

                if (profilepengusahaId.trim() === '') {
                    isValid = false;
                    document.getElementById('profile_pengusaha_id').classList.add('is-invalid');
                    errorMessages.push('Nama Pengusaha Wajib Diisi');
                    let namaPengusahaFeedback = document.querySelector(
                        '.profile-pengusaha-form-group .invalid-feedback');
                    if (namaPengusahaFeedback) {
                        namaPengusahaFeedback.textContent = 'Nama Pengusaha Wajib Diisi';
                    }
                    let namaPengusahaFeedbackJS = document.querySelector(
                        '.profile-pengusaha-form-group .invalid-feedback-js');
                    if (namaPengusahaFeedbackJS) {
                        namaPengusahaFeedbackJS.textContent = 'Nama Pengusaha Wajib Diisi';
                    }
                } else {
                    document.getElementById('profile_pengusaha_id').classList.remove('is-invalid');
                    let namaPengusahaFeedback = document.querySelector(
                        '.profile-pengusaha-form-group .invalid-feedback');
                    if (namaPengusahaFeedback) {
                        namaPengusahaFeedback.textContent = '';
                    }
                    let namaPengusahaFeedbackJS = document.querySelector(
                        '.profile-pengusaha-form-group .invalid-feedback-js');
                    if (namaPengusahaFeedbackJS) {
                        namaPengusahaFeedbackJS.textContent = '';
                    }
                }
                if (uraianresikoproyekId.trim() === '') {
                    isValid = false;
                    document.getElementById('uraian_resiko_proyek_id').classList.add('is-invalid');
                    errorMessages.push('Uraian Resiko Proyek Wajib Diisi');
                    let uraianResikoFeedback = document.querySelector(
                        '.uraian-resiko-proyek-form-group .invalid-feedback');
                    if (uraianResikoFeedback) {
                        uraianResikoFeedback.textContent = 'Uraian Resiko Proyek Wajib Diisi';
                    }
                    let uraianResikoFeedbackJS = document.querySelector(
                        '.uraian-resiko-proyek-form-group .invalid-feedback-js');
                    if (uraianResikoFeedbackJS) {
                        uraianResikoFeedbackJS.textContent = 'Uraian Resiko Proyek Wajib Diisi';
                    }
                } else {
                    document.getElementById('uraian_resiko_proyek_id').classList.remove('is-invalid');
                    let uraianResikoFeedback = document.querySelector(
                        '.uraian-resiko-proyek-form-group .invalid-feedback');
                    if (uraianResikoFeedback) {
                        uraianResikoFeedback.textContent = '';
                    }
                    let uraianResikoFeedbackJS = document.querySelector(
                        '.uraian-resiko-proyek-form-group .invalid-feedback-js');
                    if (uraianResikoFeedbackJS) {
                        uraianResikoFeedbackJS.textContent = '';
                    }
                }

                if (uraianskalausahaId.trim() === '') {
                    isValid = false;
                    document.getElementById('uraian_skala_usaha_id').classList.add('is-invalid');
                    errorMessages.push('Uraian Skala Usaha Wajib Diisi');
                    let uraianSkalaFeedback = document.querySelector(
                        '.uraian-skala-usaha-form-group .invalid-feedback');
                    if (uraianSkalaFeedback) {
                        uraianSkalaFeedback.textContent = 'Uraian Skala Usaha Wajib Diisi';
                    }
                    let uraianSkalaFeedbackJS = document.querySelector(
                        '.uraian-skala-usaha-form-group .invalid-feedback-js');
                    if (uraianSkalaFeedbackJS) {
                        uraianSkalaFeedbackJS.textContent = 'Uraian Skala Usaha Wajib Diisi';
                    }
                } else {
                    document.getElementById('uraian_skala_usaha_id').classList.remove('is-invalid');
                    let uraianSkalaFeedback = document.querySelector(
                        '.uraian-skala-usaha-form-group .invalid-feedback');
                    if (uraianSkalaFeedback) {
                        uraianSkalaFeedback.textContent = '';
                    }
                    let uraianSkalaFeedbackJS = document.querySelector(
                        '.uraian-skala-usaha-form-group .invalid-feedback-js');
                    if (uraianSkalaFeedbackJS) {
                        uraianSkalaFeedbackJS.textContent = '';
                    }
                }
                return isValid;
            }

            function validatePage4() {
                let mesinperalatan = document.getElementById('mesin_peralatan').value;
                let mesinperalatanimpor = document.getElementById('mesin_peralatan_impor').value;
                let pembelianpematangantanah = document.getElementById('pembelian_pematangan_tanah').value;
                let bangunangedung = document.getElementById('bangunan_gedung').value;
                let lainlain = document.getElementById('lain_lain').value;
                let modalkerja = document.getElementById('modal_kerja').value;
                let jumlahinvestasi = document.getElementById('jumlah_investasi').value;
                let tenagakerja = document.getElementById('tenaga_kerja').value;
                let isValid = true;
                let errorMessages = [];

                if (mesinperalatan.trim() === '') {
                    isValid = false;
                    document.getElementById('mesin_peralatan').classList.add('is-invalid');
                    errorMessages.push('Mesin Peralatan Wajib Diisi');
                    let mesinPeralatanFeedback = document.querySelector(
                        '.mesin-peralatan-form-group .invalid-feedback');
                    if (mesinPeralatanFeedback) {
                        mesinPeralatanFeedback.textContent = 'Mesin Peralatan Wajib Diisi';
                    }
                    let mesinPeralatanFeedbackJS = document.querySelector(
                        '.mesin-peralatan-form-group .invalid-feedback-js');
                    if (mesinPeralatanFeedbackJS) {
                        mesinPeralatanFeedbackJS.textContent = 'Mesin Peralatan Wajib Diisi';
                    }
                } else if (mesinperalatan === '' || isNaN(mesinperalatan)) {
                    isValid = false;
                    document.getElementById('mesin_peralatan').classList.add('is-invalid');
                    errorMessages.push('mesin peralatan tanah wajib angka');
                    let pembelianPematanganTanahFeedback = document.querySelector(
                        '.mesin-peralatan-form-group .invalid-feedback');
                    if (pembelianPematanganTanahFeedback) {
                        pembelianPematanganTanahFeedback.textContent = 'mesin peralatan wajib angka';
                    }
                    let pembelianPematanganTanahFeedbackJS = document.querySelector(
                        '.mesin-peralatan-form-group .invalid-feedback-js');
                    if (pembelianPematanganTanahFeedbackJS) {
                        pembelianPematanganTanahFeedbackJS.textContent = 'mesin peralatan wajib angka';
                    }
                } else {
                    document.getElementById('mesin_peralatan').classList.remove('is-invalid');
                    let mesinPeralatanFeedback = document.querySelector(
                        '.mesin-peralatan-form-group .invalid-feedback');
                    if (mesinPeralatanFeedback) {
                        mesinPeralatanFeedback.textContent = '';
                    }
                    let mesinPeralatanFeedbackJS = document.querySelector(
                        '.mesin-peralatan-form-group .invalid-feedback-js');
                    if (mesinPeralatanFeedbackJS) {
                        mesinPeralatanFeedbackJS.textContent = '';
                    }
                }

                if (mesinperalatanimpor.trim() === '') {
                    isValid = false;
                    document.getElementById('mesin_peralatan_impor').classList.add('is-invalid');
                    errorMessages.push('Mesin Peralatan Impor Wajib diisi');
                    let mesinPeralatanImporFeedback = document.querySelector(
                        '.mesin-peralatan-impor-form-group .invalid-feedback');
                    if (mesinPeralatanImporFeedback) {
                        mesinPeralatanImporFeedback.textContent = 'Mesin Peralatan Impor Wajib diisi';
                    }
                    let mesinPeralatanImporFeedbackJS = document.querySelector(
                        '.mesin-peralatan-impor-form-group .invalid-feedback-js');
                    if (mesinPeralatanImporFeedbackJS) {
                        mesinPeralatanImporFeedbackJS.textContent = 'Mesin Peralatan Impor Wajib diisi';
                    }
                } else {
                    document.getElementById('mesin-peralatan-impor').classList.remove('is-invalid');
                    let mesinPeralatanImporFeedback = document.querySelector(
                        '.mesin-peralatan-impor-form-group .invalid-feedback');
                    if (mesinPeralatanImporFeedback) {
                        mesinPeralatanImporFeedback.textContent = '';
                    }
                    let mesinPeralatanImporFeedbackJS = document.querySelector(
                        '.mesin-peralatan-impor-form-group .invalid-feedback-js');
                    if (mesinPeralatanImporFeedbackJS) {
                        mesinPeralatanImporFeedbackJS.textContent = '';
                    }
                }

                if (pembelianpematangantanah.trim() === '') {
                    isValid = false;
                    document.getElementById('pembelian_pematangan_tanah').classList.add('is-invalid');
                    errorMessages.push('Pembelian Pematangan Tanah Wajib Diisi');
                    let pembelianPematanganFeedback = document.querySelector(
                        '.pembelian-pematangan-tanah-form-group .invalid-feedback');
                    if (pembelianPematanganFeedback) {
                        pembelianPematanganFeedback.textContent = 'Pembelian Pematangan Tanah Wajib Diisi';
                    }
                    let pembelianPematanganFeedbackJS = document.querySelector(
                        '.pembelian-pematangan-tanah-form-group .invalid-feedback-js');
                    if (pembelianPematanganFeedbackJS) {
                        pembelianPematanganFeedbackJS.textContent = 'Pembelian Pematangan Tanah Wajib Diisi';
                    }
                } else {
                    document.getElementById('uraian_jenis_perusahaan_id').classList.remove('is-invalid');
                    let pembelianPematanganFeedback = document.querySelector(
                        '.pembelian-pematangan-tanah-form-group .invalid-feedback');
                    if (pembelianPematanganFeedback) {
                        pembelianPematanganFeedback.textContent = '';
                    }
                    let pembelianPematanganFeedbackJS = document.querySelector(
                        '.pembelian-pematangan-tanah-form-group .invalid-feedback-js');
                    if (pembelianPematanganFeedbackJS) {
                        pembelianPematanganFeedbackJS.textContent = '';
                    }
                }

                if (bangunangedung.trim() === '') {
                    isValid = false;
                    document.getElementById('uraian_resiko_proyek_id').classList.add('is-invalid');
                    errorMessages.push('Uraian Resiko Proyek Wajib Diisi');
                    let uraianResikoFeedback = document.querySelector(
                        '.uraian-resiko-proyek-form-group .invalid-feedback');
                    if (uraianResikoFeedback) {
                        uraianResikoFeedback.textContent = 'Uraian Resiko Proyek Wajib Diisi';
                    }
                    let uraianResikoFeedbackJS = document.querySelector(
                        '.uraian-resiko-proyek-form-group .invalid-feedback-js');
                    if (uraianResikoFeedbackJS) {
                        uraianResikoFeedbackJS.textContent = 'Uraian Resiko Proyek Wajib Diisi';
                    }
                } else {
                    document.getElementById('uraian_resiko_proyek_id').classList.remove('is-invalid');
                    let uraianResikoFeedback = document.querySelector(
                        '.uraian-resiko-proyek-form-group .invalid-feedback');
                    if (uraianResikoFeedback) {
                        uraianResikoFeedback.textContent = '';
                    }
                    let uraianResikoFeedbackJS = document.querySelector(
                        '.uraian-resiko-proyek-form-group .invalid-feedback-js');
                    if (uraianResikoFeedbackJS) {
                        uraianResikoFeedbackJS.textContent = '';
                    }
                }

                if (lainlain.trim() === '') {
                    isValid = false;
                    document.getElementById('uraian_skala_usaha_id').classList.add('is-invalid');
                    errorMessages.push('Uraian Skala Usaha Wajib Diisi');
                    let uraianSkalaFeedback = document.querySelector(
                        '.uraian-skala-usaha-form-group .invalid-feedback');
                    if (uraianSkalaFeedback) {
                        uraianSkalaFeedback.textContent = 'Uraian Skala Usaha Wajib Diisi';
                    }
                    let uraianSkalaFeedbackJS = document.querySelector(
                        '.uraian-skala-usaha-form-group .invalid-feedback-js');
                    if (uraianSkalaFeedbackJS) {
                        uraianSkalaFeedbackJS.textContent = 'Uraian Skala Usaha Wajib Diisi';
                    }
                } else {
                    document.getElementById('uraian_skala_usaha_id').classList.remove('is-invalid');
                    let uraianSkalaFeedback = document.querySelector(
                        '.uraian-skala-usaha-form-group .invalid-feedback');
                    if (uraianSkalaFeedback) {
                        uraianSkalaFeedback.textContent = '';
                    }
                    let uraianSkalaFeedbackJS = document.querySelector(
                        '.uraian-skala-usaha-form-group .invalid-feedback-js');
                    if (uraianSkalaFeedbackJS) {
                        uraianSkalaFeedbackJS.textContent = '';
                    }
                }
                return isValid;
            }
            nextButton1.addEventListener('click', () => {
                const isValid = validatePage1();
                if (isValid) {
                    document.getElementById("titletables").innerHTML = "Validasi Tambah Alamat";
                    // Hide the current page and show the next page
                    $('#site-2').addClass(" current-item");
                    $('#site-1').removeClass(" current-item");
                    page2.style.display = 'block';
                    page1.style.display = 'none';
                    page3.style.display = 'none';
                    page4.style.display = 'none';
                }
            });
            backButton2.addEventListener('click', () => {
                document.getElementById("titletables").innerHTML = "Validasi Tambah Perusahaan";
                // Hide the current page and show the previous page
                $('#site-1').addClass(" current-item");
                $('#site-2').removeClass(" current-item");
                page1.style.display = 'block';
                page2.style.display = 'none';
                page3.style.display = 'none';
                page4.style.display = 'none';
            });
            nextButton2.addEventListener('click', () => {
                const isValid = validatePage2();
                if (isValid) {
                    document.getElementById("titletables").innerHTML = "Validasi Tambah Status";
                    // Hide the current page and show the next page
                    $('#site-3').addClass(" current-item");
                    $('#site-2').removeClass(" current-item");
                    page3.style.display = 'block';
                    page1.style.display = 'none';
                    page2.style.display = 'none';
                    page4.style.display = 'none';
                }
            });
            nextButton3.addEventListener('click', () => {
                const isValid = validatePage3();
                if (isValid) {
                    document.getElementById("titletables").innerHTML = "Validasi Tambah Total Pembiayaan";
                    // Hide the current page and show the next page
                    $('#site-4').addClass(" current-item");
                    $('#site-3').removeClass(" current-item");
                    page4.style.display = 'block';
                    page1.style.display = 'none';
                    page2.style.display = 'none';
                    page3.style.display = 'none';
                }
            });

            backButton3.addEventListener('click', () => {
                document.getElementById("titletables").innerHTML = "Validasi Tambah Alamat";
                // Hide the current page and show the previous page
                $('#site-2').addClass(" current-item");
                $('#site-3').removeClass(" current-item");
                page2.style.display = 'block';
                page1.style.display = 'none';
                page3.style.display = 'none';
                page4.style.display = 'none';
            });

            backButton4.addEventListener('click', () => {
                document.getElementById("titletables").innerHTML = "Validasi Tambah Status";
                // Hide the current page and show the previous page
                $('#site-3').addClass(" current-item");
                $('#site-4').removeClass(" current-item");
                page3.style.display = 'block';
                page4.style.display = 'none';
                page1.style.display = 'none';
                page2.style.display = 'none';
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

    {{-- <script>
        "use strict";

        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone("#mydropzone", {
            url: "{{ route('kbli-perusahaan.update', $kbli_perusahaan->id) }}",
            paramName: "gambar",
            maxFilesize: 5,
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: true,
            dictDefaultMessage: "Drop files here or click to upload",
            init: function () {
                var self = this;
                var minSteps = 6,
                    maxSteps = 60,
                    timeBetweenSteps = 100,
                    bytesPerStep = 100000;

                self.uploadFiles = function (files) {
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        var totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

                        for (var step = 0; step < totalSteps; step++) {
                            var duration = timeBetweenSteps * (step + 1);
                            setTimeout(function (file, totalSteps, step) {
                                return function () {
                                    file.upload = {
                                        progress: 100 * (step + 1) / totalSteps,
                                        total: file.size,
                                        bytesSent: (step + 1) * file.size / totalSteps
                                    };

                                    self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
                                    if (file.upload.progress == 100) {
                                        file.status = Dropzone.SUCCESS;
                                        self.emit("success", file, 'success', null);
                                        self.emit("complete", file);
                                        self.processQueue();
                                    }
                                };
                            }(file, totalSteps, step), duration);
                        }
                    }
                };

                self.on("removedfile", function (file) {
                    // Menghapus gambar yang dihapus dari form
                    var filename = file.name;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('kbli-perusahaan.update', $kbli_perusahaan->id) }}',
                        data: {
                            _method: 'PUT',
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _delete: true,
                            filename: filename
                        },
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                });
            },
            success: function (file, response) {
                // Sukses upload
                file.upload.filename = response.filename;
                $(file.previewElement).find('.dz-remove').attr('data-filename', response.filename);
            },
            error: function (file, errorMessage) {
                // Gagal upload
                console.log(errorMessage);
            }
        });
    </script> --}}
@endpush

@push('customStyle')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" />

    <link rel="stylesheet" href="/assets/css/select2.min.css">
    <style>
        #preview {
            padding: 15px 15px;
            color: #80b8ff;
        }

        .custom-button-class {
            padding: 8px 16px;
            background-color: #e53935;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 10px;
        }

        .custom-button-class:hover {
            background-color: #c62828;
        }

        .preview-with-border {
            border-style: dashed;
            border-width: 2px;
            /* border-color: #ddd; */
        }

        img {
            vertical-align: middle;
            border-style: none;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: auto;
            margin: 10px;
        }
    </style>
@endpush