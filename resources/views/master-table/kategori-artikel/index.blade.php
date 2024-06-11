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
                            <h4>List Kategori</h4>
                            <div class="card-header-action">
                                <a href="{{ route('kategori-artikel.create') }}" class="btn btn-icon icon-left btn-primary"
                                    data-id="tambah">Tambah Data</a>
                                <a class="btn btn-info btn-primary active import" data-id="import">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Import Kategori Artikel</a>
                                <a class="btn btn-info btn-primary active" href="{{ route('kategori-artikel.export') }}"
                                    data-id="export">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Export Kategori Artikel</a>
                                <a class="btn btn-info btn-primary active search" data-id="search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Kategori Artikel</a>
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
                                    <form action="{{ route('kategori-artikel.import') }}" method="POST" enctype="multipart/form-data">
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
                                <form id="search" method="GET" action="{{ route('kategori-artikel.index') }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="role">Nama Kategori</label>
                                            <input type="text" name="nama_kategori" class="form-control" id="judul_kbli"
                                                placeholder="Nama Kategori" data-id="search-kategori">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1 button" type="submit"
                                            data-id="submit-search">Submit</button>
                                        <a class="btn btn-secondary" href="{{ route('kategori-artikel.index') }}"
                                            data-id="cancel">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Kategori</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        @foreach ($kategoriArtikel as $key => $ktgArt)
                                            <tr>
                                                <td>{{ ($kategoriArtikel->currentPage() - 1) * $kategoriArtikel->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $ktgArt->nama_kategori }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="{{ route('kategori-artikel.edit', $ktgArt->id) }}"
                                                            class="btn btn-sm btn-info btn-icon "
                                                            data-id="edt-{{ $ktgArt->id }}"><i class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <form action="{{ route('kategori-artikel.destroy', $ktgArt->id) }}"
                                                            method="POST" class="ml-2" id="del-<?= $ktgArt->id ?>">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button type="submit" class="btn btn-sm btn-danger btn-icon "
                                                                data-confirm="Hapus Data Kategori ?|Apakah Kamu Yakin?"
                                                                data-confirm-yes="submitDel(<?= $ktgArt->id ?> )"
                                                                data-id="del-{{ $ktgArt->id }}"><i
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
                                    {{ $kategoriArtikel->withQueryString()->links() }}
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
