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
                            <h4>List Artikel</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('artikel.create') }}"
                                    data-id="tambah">Tambah
                                    Data Artikel</a>
                                <a class="btn btn-info btn-primary active import" data-id="import">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Import Artikel</a>
                                <a class="btn btn-info btn-primary active" href="{{ route('artikel.export') }}"
                                    data-id="export">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Export Artikel</a>
                                <a class="btn btn-info btn-primary active search" data-id="search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Artikel</a>
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
                                    <form action="{{ route('artikel.import') }}" method="POST"
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
                                <form id="search" method="GET" action="{{ route('artikel.index') }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="role">Judul artikel</label>
                                            <input type="text" name="judul" class="form-control"
                                                id="judul" placeholder="Judul artikel" data-id="search-judul">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="role">Penerbit</label>
                                            <input type="text" name="name" class="form-control"
                                                id="name" placeholder="Penerbit" data-id="search-name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="role">Kategori</label>
                                            <input type="text" name="kategori" class="form-control"
                                                id="kategori" placeholder="Kategori" data-id="search-kategori">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1 button" type="submit"
                                            data-id="submit-search">Submit</button>
                                        <a class="btn btn-secondary" href="{{ route('artikel.index') }}"
                                            data-id="cancel">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Penerbit</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Gambar</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                          </tr>
                                      @foreach($artikels as $key => $art)
                                      <tr>
                                      <td>{{ ($artikels->currentPage() - 1) * $artikels->perPage() + $key + 1 }}</td>
                                      <td>{{ $art->judul }}</td>
                                      <td>{{ $art->name}}</td>
                                      <td>{{ $art->kategori}}</td>
                                      <td>{!! $art->deskripsi !!}</td>
                                      <td><img src="{{ Storage::url($art->path) }}" alt="{{ $art->judul }}" width="100"></td>
                                      <td>{{ $art->slug}}</td>
                                      <td class="text-right">
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('artikel.edit', $art->id) }}"
                                                class="btn btn-sm btn-info btn-icon "
                                                data-id="edt-{{ $art->id }}"><i class="fas fa-edit"></i>
                                                Edit</a>
                                            <a href="{{ route('artikel.show', $art->id) }}"
                                                class="btn btn-sm btn-warning btn-icon ml-2"
                                                data-id="shw-{{ $art->id }}"><i class="fas fa-eye"></i>
                                                Show</a>
                                            <form action="{{ route('artikel.destroy', $art->id) }}"
                                                method="POST" class="ml-2" id="del-<?= $art->id ?>">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token"
                                                    value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-sm btn-danger btn-icon "
                                                    data-confirm="Hapus Data artikel ?|Apakah Kamu Yakin?"
                                                    data-confirm-yes="submitDel(<?= $art->id ?> )"
                                                    data-id="del-{{ $art->id }}"><i
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
                                    {{ $artikels->withQueryString()->links() }}
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
         function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>
@endpush

