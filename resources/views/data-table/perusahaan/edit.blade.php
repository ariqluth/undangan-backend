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
            <div class="card">
                <div class="card-header">
                    <h4>Validasi Edit Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('perusahaan.update', $perusahaan) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan"
                                value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}"
                                data-id="nama-perusahaan">
                            @error('nama_perusahaan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nib">NIB</label>
                            <input type="text" class="form-control @error('nib') is-invalid @enderror" id="nib"
                                name="nib" placeholder="NIB" value="{{ old('nib', $perusahaan->nib) }}" data-id="nib">
                            @error('nib')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>>Status Penanaman Modal</label>
                            <select id="penanaman_modal_id" name="penanaman_modal_id"
                                class="form-control select2 @error('penanaman_modal_id') is-invalid @enderror"
                                data-id="select-pmdn">
                                <option value="">Pilih Penanaman Moda</option>
                                @foreach ($pemodalans as $pemodalan)
                                    <option @selected($pemodalan->id == $perusahaan->penanaman_modal_id) value="{{ $pemodalan->id }}">
                                        {{ $pemodalan->status_pmdn }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kabupaten_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>>Uraian Jenis Perusahaan</label>
                            <select id="uraian_jenis_perusahaan_id" name="uraian_jenis_perusahaan_id"
                                class="form-control select2 @error('uraian_jenis_perusahaan_id') is-invalid @enderror"
                                data-id="select-uraian-jenis-perusahaan">
                                <option value="">Pilih Penanaman Moda</option>
                                @foreach ($uraianjenisperusahaans as $uraianjenisperusahaan)
                                    <option @selected($uraianjenisperusahaan->id == $perusahaan->uraian_jenis_perusahaan_id) value="{{ $uraianjenisperusahaan->id }}">
                                        {{ $uraianjenisperusahaan->nama_uraian_jenis_perusahaan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kabupaten_id')
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
                                    <option @selected($kabupaten->id == $perusahaan->kabupaten_id) value="{{ $kabupaten->id }}">
                                        {{ $kabupaten->nama_kabupaten }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kabupaten_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Usaha</label>
                            <input id="alamat" name="alamat" type="text"
                                class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat Usaha"
                                value="{{ old('alamat', $perusahaan->alamat) }}" data-id="alamat-usaha">
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
                                value="{{ old('email', $perusahaan->email) }}" data-id="email">
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
                                value="{{ old('no_telp', $perusahaan->no_telp) }}" data-id="no_telp">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                </div>
                <div class="card-footer text-right">
                    <button id="button" class="btn btn-primary" data-id="submit-perusahaan">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('perusahaan.index') }}">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
    {{-- <script type="text/javascript">
        jQuery(document).ready(function() {
            $('#kabupaten_id').change(function() {
                var kabupatenId = this.value;
                $('#kecamatan_id').html('<option value="">Pilih Nama Kecamatan</option>');
                $.ajax({
                    url: '{{ route('kecamatan.filter') }}',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        kabupaten_id: kabupatenId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#kecamatan_id').html(
                            '<option value="">Pilih Nama Kecamatan</option>');
                        $.each(response['Kecamatan'], function(index, val) {
                            $('#kecamatan_id').append('<option value="' + val.id +
                                '"> ' + val.nama_kecamatan + ' </option>')
                        });
                        $('#kelurahan_id').html(
                            '<option value="">Pilih Nama Kelurahan</option>');
                    }
                });
            });
            $('#kecamatan_id').change(function() {
                var kecamatanId = this.value;
                $('#kelurahan_id').html('<option value="">Pilih Nama Kelurahan</option>');
                $.ajax({
                    url: '{{ route('kelurahan.filter') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        kecamatan_id: kecamatanId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(kecamatanId);
                        $('#kelurahan_id').html(
                            '<option value="">Pilih Nama Kelurahan</option>');
                        $.each(response['Kelurahan'], function(index, val) {
                            console.log(response.Kelurahan)
                            $('#kelurahan_id').append('<option value="' + val.id +
                                '"> ' + val.nama_kelurahan + ' </option>')
                        });
                    }
                });
            });

            var selectkab = ({{ $perusahaan->kabupaten_id }});
            var selectkecId = "{{ $perusahaan->kecamatan->id }}";
            var selectkecSe = "{{ $kecamatans }}"
            var data = JSON.parse(selectkecSe.replace(/&quot;/g, '"'));
            $('#kecamatan_id').empty();
            $.ajax({
                url: '{{ route('loadK.filter') }}',
                type: 'get',
                dataType: 'json',
                data: {
                    kabupaten_id: selectkab
                },
                success: function(response, items) {
                    $.each(data, function(index, val) {
                        if (val.kabupaten_id == selectkab) {
                            console.log('<option value="' + val.id + '" >' +
                                val.nama_kecamatan + '</option>')
                            $('#kecamatan_id').append('<option value="' + val.id + '" >' +
                                val.nama_kecamatan + '</option>')
                            $("#kecamatan_id option[value='" + selectkecId + "']").attr(
                                "selected", "selected");
                        }
                    });
                }
            });

            var selectkecPerusahaan = ({{ $perusahaan->kecamatan_id }});
            var selectkelId = "{{ $perusahaan->kelurahan->id }}";
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



        }); --}}
    {{-- </script> --}}
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
