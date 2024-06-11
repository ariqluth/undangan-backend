@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Security Kbli Perusahaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Security Management</h2>
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>List Kbli Perusahaan</h4>
                            <div class="card-header-action">
                                <a class="btn btn-info btn-primary active search" data-id="search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Perusahaan</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="">
                                    <div class="form-col">
                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="role">Nama Perusahaan</label>
                                                <input type="text" name="nama_perusahaan" class="form-control"
                                                    id="nama_perusahaan" placeholder="Nama Perusahaan"
                                                    data-id="search-perusahaan" value="{{ $nama_perusahaan }}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="role">Nama Pengusaha</label>
                                                <input type="text" name="nama_pengusaha" class="form-control"
                                                    id="nama_pengusaha" placeholder="Nama Pengusaha"
                                                    data-id="search-pengusaha" value="{{ $nama_pengusaha }}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="role">Alamat</label>
                                                <input type="text" name="alamat" class="form-control" id="alamat"
                                                    placeholder="Alamat" data-id="search-alamat"
                                                    value="{{ $alamat }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label for="role">Kecamatan</label>
                                                <select class="form-control select2" name="kecamatan[]" multiple
                                                    data-id="select-Kecamatan" id="kecamatan">
                                                    <option value="">Pilih Kecamatan </option>
                                                    @foreach ($kecamatans as $kecamatan)
                                                        <option value="{{ $kecamatan->id }}"
                                                            {{ (is_array(old('kecamatan')) && in_array($kecamatan->id, old('kecamatan'))) || (isset($kecamatanSelected) && in_array($kecamatan->id, $kecamatanSelected)) ? 'selected' : '' }}>
                                                            {{ $kecamatan->nama_kecamatan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label for="role">Kelurahan</label>
                                                <select class="form-control select2 kelurahan" name="kelurahan[]" multiple
                                                    data-id="select-kelurahan" id="kelurahan">
                                                    <option value="">Pilih Kelurahan </option>
                                                    @foreach ($kelurahans as $kelurahan)
                                                        <option value="{{ $kelurahan->id }}"
                                                            {{ (is_array(old('kelurahan')) && in_array($kelurahan->id, old('kelurahan'))) || (isset($kelurahanSelected) && in_array($kelurahan->id, $kelurahanSelected)) ? 'selected' : '' }}>
                                                            {{ $kelurahan->nama_kelurahan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-row">
                                            <div class="form-group col-md-11">
                                                <label for="role">KBLI</label>
                                                <select class="form-control select2" name="kbli[]" multiple
                                                    data-id="select-kbli" id="kbli">
                                                    <option value="">Pilih KBLI </option>
                                                    @foreach ($kblis as $kbli)
                                                        <option value="{{ $kbli->id }}"
                                                            {{ (is_array(old('kbli')) && in_array($kbli->id, old('kbli'))) || (isset($kbliSelected) && in_array($kbli->id, $kbliSelected)) ? 'selected' : '' }}>
                                                            {{ $kbli->kbli }} - {{ $kbli->judul_kbli }} -
                                                            {{ $kbli->sektor }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1 button" type="submit"
                                            data-id="submit-search">Submit</button>
                                        <a class="btn btn-secondary" href="{{ route('kbli-perusahaan.index') }}"
                                            data-id="reset">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <label for="role" style="font-weight: bold">Total: {{ $kbliperusahaanCount }}</label>

                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Kbli</th>
                                            <th>Judul Kbli</th>
                                            <th>Sektor</th>
                                            <th>Kode Proyek</th>
                                            <th>NPWP</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        @foreach ($kbliperusahaans as $key => $kbliperusahaan)
                                            <tr>
                                                <td>{{ ($kbliperusahaans->currentPage() - 1) * $kbliperusahaans->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $kbliperusahaan->nama_perusahaan }}</td>
                                                <td>{{ $kbliperusahaan->kbli }}</td>
                                                <td>{{ $kbliperusahaan->judul_kbli }}</td>
                                                <td>{{ $kbliperusahaan->sektor }}</td>
                                                <td>{{ $kbliperusahaan->kode_proyek }}</td>
                                                <td>{{ $kbliperusahaan->npwp }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-info btn-icon toggle-details ml-2"
                                                            data-target="#details-{{ $kbliperusahaan->kbliperusahaan_Id }}">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="details-{{ $kbliperusahaan->kbliperusahaan_Id }}"
                                                style="display: none;">
                                                <td colspan="10">
                                                    <h6>Status Data</h6>
                                                    <table class="table table-bordered table-md">
                                                        <tr>
                                                            <th>Created At</th>
                                                            <th>Created By</th>
                                                            <th>Updated At</th>
                                                            <th>Updated By</th>
                                                            <th>Status Terhapus</th>
                                                            <th>Delete By</th>
                                                            <th>Delete At</th>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $kbliperusahaan->created_at }}</td>
                                                            <td>{{ $kbliperusahaan->created_by_name }}</td>
                                                            <td>{{ $kbliperusahaan->updated_at }}</td>
                                                            <td>{{ $kbliperusahaan->updated_by_name }}</td>
                                                            <td>{{ $kbliperusahaan->data_terhapus }}</td>
                                                            <td>{{ $kbliperusahaan->delete_by_name }}</td>
                                                            <td>{{ $kbliperusahaan->deleted_at }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {{ $kbliperusahaans->withQueryString()->links() }}

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
    <script>
        $(document).ready(function() {
            $('.import').click(function(event) {
                event.stopPropagation();
                $(".show-import").slideToggle("fast");
                $(".show-search").hide();
            });
            $('.search').click(function(event) {
                event.stopPropagation();
                $(".show-search").slideToggle("fast");
                $(".show-import").hide();
            });
            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });

        function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>


    <script>
        $(document).ready(function() {
            var detailStatus = {};
            $('.form-control select2 kelurahan').select2();
            $('#kecamatan').change(function() {
                var kecamatanIds = $(this).val();
                $('#kelurahan').html('<option value="">Pilih Nama Kelurahan</option>');
                $.ajax({
                    url: '{{ route('kelurahan.filter') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        kecamatan_id: kecamatanIds,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(kecamatanIds)
                        $('#kelurahan').html('<option value="">Pilih Nama Kelurahan</option>');
                        $.each(response['Kelurahan'], function(index, val) {
                            console.log(response);
                            $('#kelurahan').append('<option value="' + val.id +
                                '"> ' + val.nama_kelurahan + ' </option>')
                        });
                    }
                });
            });

            $('.toggle-details').click(function() {
                var targetId = $(this).data('target');
                var kbliperusahaanId = targetId.split('-')[1];

                for (var id in detailStatus) {
                    if (id != kbliperusahaanId && detailStatus[id] === true) {
                        $('#details-' + id).toggle();
                        $('.toggle-details[data-target="#details-' + id + '"] i')
                            .toggleClass('fa-chevron-down fa-chevron-up');
                        detailStatus[id] = false;
                    }
                }

                $(targetId).toggle();
                $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
                detailStatus[kbliperusahaanId] = $(targetId).is(':visible');
            });
        });
    </script>
@endpush
@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
