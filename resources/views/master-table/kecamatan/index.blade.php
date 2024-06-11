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
            <h2 class="section-title">Master Table Management</h2>
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>List Kecamatan</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('kecamatan.create') }}"
                                    data-id="tambah">Tambah
                                    Data
                                    Kecamatan</a>
                                <a class="btn btn-info btn-primary active import" data-id="import">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Import Kecamatan</a>
                                <a class="btn btn-info btn-primary active" href="{{ route('kecamatan.export') }}"
                                    data-id="export">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Export Kecamatan</a>
                                <a class="btn btn-info btn-primary active search" data-id="search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Kecamatan</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="show-import mb-4" style="display: none">
                                @error('import-file')
                                    <div class="invalid-feedback d-flex mb-10" role="alert">
                                        <div class="alert_alert-dange_mt-1_mb-1">
                                            {{ $message }}
                                        </div>
                                    </div>
                                @enderror
                                <div class="custom-file">
                                    <form action="{{ route('kecamatan.import') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <label class="custom-file-label" for="file-upload">Choose File</label>
                                        <input type="file" id="file-upload" class="custom-file-input" name="import-file"
                                            data-id="send-import">
                                        <br /> <br />
                                        <div class="footer text-right">
                                            <button class="btn btn-primary" data-id="submit-import">Import File</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="{{ route('kecamatan.index') }}">
                                    <div class="form-col">
                                        <div class="form-row">
                                            <div class="form-group col-md-7">
                                                <label for="role">Kabupaten</label>
                                                <input type="text" name="nama_kabupaten" class="form-control"
                                                    id="nama_kabupaten" placeholder="Nama Kabupaten"
                                                    data-id="search-kabupaten">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-7">
                                                <label for="role">Kecamatan</label>
                                                <input type="text" name="nama_kecamatan" class="form-control"
                                                    id="nama_kecamatan" placeholder="Nama Kecamatan"
                                                    data-id="search-kecamatan">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1 button" type="submit"
                                            data-id="submit-search">Submit</button>
                                        <a class="btn btn-secondary" href="{{ route('kecamatan.index') }}"
                                            data-id="reset">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Kabupaten</th>
                                            <th>Nama Kecamatan</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        @foreach ($kecamatans as $key => $kecamatan)
                                            <tr>
                                                <td>{{ ($kecamatans->currentPage() - 1) * $kecamatans->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $kecamatan->nama_kabupaten }}
                                                </td>
                                                <td>{{ $kecamatan->nama_kecamatan }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="{{ route('kecamatan.edit', $kecamatan->id) }}"
                                                            class="btn btn-sm btn-info btn-icon "
                                                            data-id="edt-{{ $kecamatan->id }}"><i class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <form action="{{ route('kecamatan.destroy', $kecamatan->id) }}"
                                                            method="POST" class="ml-2" id="del-<?= $kecamatan->id ?>">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button type="submit" class="btn btn-sm btn-danger btn-icon"
                                                                data-confirm="Hapus Data Kecamatan?|Apakah Kamu Yakin?"
                                                                data-confirm-yes="submitDel(<?= $kecamatan->id ?>)"
                                                                data-id="del-{{ $kecamatan->id }}"
                                                                onclick="return false;">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $kecamatans->withQueryString()->links() }}
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
@endpush
@push('customStyle')
@endpush
