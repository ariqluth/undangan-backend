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
            <h2 class="section-title">Data Table Management</h2>
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>List Profile Pengusaha</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('profile-pengusaha.create') }}"
                                    data-id="tambah">Tambah Data
                                    Profile Pengusaha</a>
                                <a class="btn btn-info btn-primary active import" data-id="import">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Import Profile Pengusaha</a>
                                <a class="btn btn-info btn-primary active" href="{{ route('profile.pengusaha.export') }}"
                                    data-id="export">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Export Profile Pengusaha</a>
                                <a class="btn btn-info btn-primary active search" data-id="search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Profile Pengusaha</a>
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
                                    <form action="{{ route('profile.pengusaha.import') }}" method="post"
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
                                <form id="search" method="GET" action="">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="role">Profile Pengusaha</label>
                                            <input type="text" name="nama_pengusaha" class="form-control"
                                                id="nama_pengusaha" placeholder="Nama Pengusaha"
                                                data-id="search-profile-pengusaha">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1 button" type="submit"
                                            data-id="submit-search">Submit</button>
                                        <a class="btn btn-secondary" href="" data-id="reset">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Nomor Indentitas User</th>
                                            <th>Nama Pengusaha</th>
                                            <th>Nomor Telpon</th>
                                            <th>Email</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        @foreach ($profile_pengusahas as $key => $profile_pengusaha)
                                            <tr>
                                                <td>{{ ($profile_pengusahas->currentPage() - 1) * $profile_pengusahas->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $profile_pengusaha->nomor_identitas_user }}</td>
                                                <td>{{ $profile_pengusaha->nama_pengusaha }}</td>
                                                <td>{{ $profile_pengusaha->no_telp }}</td>
                                                <td>{{ $profile_pengusaha->email }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="{{ route('profile-pengusaha.edit', $profile_pengusaha->id) }}"
                                                            class="btn btn-sm btn-info btn-icon "
                                                            data-id="edt-{{ $profile_pengusaha->id }}"><i
                                                                class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <form
                                                            action="{{ route('profile-pengusaha.destroy', $profile_pengusaha->id) }}"
                                                            method="POST" class="ml-2"
                                                            id="del-<?= $profile_pengusaha->id ?>">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button type="submit" id="#submit"
                                                                class="btn btn-sm btn-danger btn-icon "
                                                                data-confirm="Hapus Data Profile Pengusaha?|Apakah Kamu Yakin?"
                                                                data-confirm-yes="submitDel(<?= $profile_pengusaha->id ?>)"
                                                                data-id="del-{{ $profile_pengusaha->id }}">
                                                                <i class="fas fa-times"> </i> Delete </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $profile_pengusahas->withQueryString()->links() }}

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
