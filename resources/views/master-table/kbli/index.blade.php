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
                            <h4>List KBLI</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('kbli.create') }}"
                                    data-id="tambah">Tambah
                                    Data KBLI</a>
                                <a class="btn btn-info btn-primary active import" data-id="import">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Import KBLI</a>
                                <a class="btn btn-info btn-primary active" href="{{ route('kbli.export') }}"
                                    data-id="export">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Export KBLI</a>
                                <a class="btn btn-info btn-primary active search" data-id="search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search KBLI</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="show-import" style="display: none">
                                @error('import-file')
                                    <div class="invalid-feedback d-flex mb-10" role="alert">
                                        <div class="alert_alert-dange_mt-1_mb-1">
                                            {{ $message }}
                                        </div>
                                    </div>
                                @enderror
                                <div class="custom-file">
                                    <form action="{{ route('kbli.import') }}" method="POST"
                                        enctype="multipart/form-data" >
                                        @csrf
                                        @method('POST')
                                        <label
                                            class="custom-file-label @error('import-file', 'ImportKabupatenRequest') is-invalid @enderror"
                                            for="file-upload">Choose File</label>
                                        <input type="file" id="file-upload" class="custom-file-input" name="import-file"
                                            data-id="send-import">
                                        <br /> <br />
                                        <div class="footer text-right">
                                            <button class="btn btn-primary" data-id="button-import">Import File</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="{{ route('kbli.index') }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="role">Judul KBLI</label>
                                            <input type="text" name="judul_kbli" class="form-control"
                                                id="judul_kbli" placeholder="Judul KBLI" data-id="search-kbli">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1 button" type="submit"
                                            data-id="submit-search">Submit</button>
                                        <a class="btn btn-secondary" href="{{ route('kbli.index') }}"
                                            data-id="cancel">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>KBLI</th>
                                            <th>Judul KBLI</th>
                                            <th>Sektor</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        @foreach ($kblis as $key => $kbli)
                                            <tr>
                                                <td>{{ ($kblis->currentPage() - 1) * $kblis->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $kbli->kbli }}</td>
                                                <td>{{ $kbli->judul_kbli }}</td>
                                                <td>{{ $kbli->sektor }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="{{ route('kbli.edit', $kbli->id) }}"
                                                            class="btn btn-sm btn-info btn-icon "
                                                            data-id="edt-{{ $kbli->id }}"><i class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <form action="{{ route('kbli.destroy', $kbli->id) }}"
                                                            method="POST" class="ml-2" id="del-<?= $kbli->id ?>">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button type="submit" class="btn btn-sm btn-danger btn-icon "
                                                                data-confirm="Hapus Data KBLI ?|Apakah Kamu Yakin?"
                                                                data-confirm-yes="submitDel(<?= $kbli->id ?> )"
                                                                data-id="del-{{ $kbli->id }}"><i
                                                                    class="fas fa-times"></i>
                                                                Delete </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $kblis->withQueryString()->links() }}
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
    <script>
        $(document).ready(function() {
            $('.form-control' || '.form-control select2').on('input change', function() {
                if ($(this).val() == '') {
                    $('.button').attr('disabled', true);
                } else {
                    $('.button').removeAttr('disabled', false);
                }
            });
        });
    </script>
@endpush

@push('customStyle')
@endpush
