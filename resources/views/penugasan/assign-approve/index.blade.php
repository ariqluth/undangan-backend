@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Penugasan Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Penugasan Management</h2>
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>List Penugasan</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('assign-approve.create') }}"
                                    data-id="tambah">Tambah Data
                                    Penugasan</a>
                                <a class="btn btn-info btn-primary active search" data-id="search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Penugasan</a>
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
                                    <form action="#" method="post" enctype="multipart/form-data">
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
                                    <div class="form-col">
                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="role">Nama Perusahaan</label>
                                                <input type="text" name="nama_perusahaan" class="form-control"
                                                    id="nama_perusahaan" placeholder="Nama Perusahaan"
                                                    data-id="search-perusahaan" value="{{ $nama_perusahaan }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label for="role">User</label>
                                                <select class="form-control select2" name="users[]" multiple
                                                    data-id="select-Users" id="users">
                                                    <option value="">Pilih User </option>
                                                    @foreach ($users as $users)
                                                        <option value="{{ $users->id }}"
                                                            {{ (is_array(old('users')) && in_array($users->id, old('users'))) || (isset($usersSelected) && in_array($users->id, $usersSelected)) ? 'selected' : '' }}>
                                                            {{ $users->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
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
                                        <a class="btn btn-secondary" href="{{ route('assign-approve.index') }}"
                                            data-id="reset">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                {{-- <label for="role" style="font-weight: bold">Total: {{ $assignApprovedCount }}</label> --}}

                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Approved At</th>
                                            <th>Approved By</th>
                                            <th>Status</th>
                                            <th>Status Perubahan</th>
                                            <th>Assign To</th>
                                            <th class="text-right">Approved</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        @foreach ($assignApprove as $key => $assignApproved)
                                            <tr>
                                                <td>{{ ($assignApprove->currentPage() - 1) * $assignApprove->perPage() + $key + 1 }}
                                                </td>
                                                <td>{{ $assignApproved->approve_at }}</td>
                                                <td>{{ $assignApproved->approved_by_name }}</td>
                                                <td>{{ $assignApproved->status }}</td>
                                                <td>{{ $assignApproved->perubahan }}</td>
                                                <td>{{ $assignApproved->assign_to_name }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-end">
                                                        @if (is_null($assignApproved->approve_at))
                                                            <form
                                                                action="{{ route('assign-approve.approve', $assignApproved->assign_approve_id) }}"
                                                                method="POST" class="d-inline-block"
                                                                id="vel-{{ $assignApproved->assign_approve_id }}">
                                                                @csrf
                                                                <button type="submit" class="tn btn-sm btn-primary ml-2"
                                                                    data-confirm="Approve KBLI Perusahaan?|Apakah Kamu Yakin?"
                                                                    data-confirm-yes="submitVeri({{ $assignApproved->assign_approve_id }})"
                                                                    data-id="vel-{{ $assignApproved->assign_approve_id }}">Approve</button>
                                                            </form>
                                                            @if ($assignApproved->status == 'pending')
                                                                <form
                                                                    action="{{ route('assign-approve.reject', $assignApproved->assign_approve_id) }}"
                                                                    method="POST" class="d-inline-block"
                                                                    id="vel-reject-{{ $assignApproved->assign_approve_id }}">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="tn btn-sm btn-danger ml-2"
                                                                        data-confirm="Reject KBLI Perusahaan?|Apakah Kamu Yakin?"
                                                                        data-confirm-yes="submitReject({{ $assignApproved->assign_approve_id }})"
                                                                        data-id="vel-reject-{{ $assignApproved->assign_approve_id }}">Reject</button>
                                                                </form>
                                                            @endif
                                                        @else
                                                            <form
                                                                action="{{ route('assign-approve.unapprove', $assignApproved->assign_approve_id) }}"
                                                                method="POST" class="d-inline-block"
                                                                id="vel-{{ $assignApproved->assign_approve_id }}">
                                                                @csrf
                                                                <button type="submit" class="tn btn-sm btn-primary ml-2"
                                                                    data-confirm="Remove verification for KBLI Perusahaan?|Apakah Kamu Yakin?"
                                                                    data-confirm-yes="submitVeri({{ $assignApproved->assign_approve_id }})"
                                                                    data-id="vel-{{ $assignApproved->assign_approve_id }}">Remove
                                                                    Verif</button>
                                                            </form>
                                                        @endif

                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="{{ route('assign-approve.edit', $assignApproved->assign_approve_id) }}"
                                                            class="btn btn-sm btn-info btn-icon "
                                                            data-id="edt-{{ $assignApproved->assign_approve_id }}"><i
                                                                class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <form
                                                            action="{{ route('assign-approve.destroy', $assignApproved->assign_approve_id) }}"
                                                            method="POST" class="ml-2"
                                                            id="del-<?= $assignApproved->assign_approve_id ?>">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button type="submit" id="#submit"
                                                                class="btn btn-sm btn-danger btn-icon "
                                                                data-confirm="Hapus KBLI Perusahaan?|Apakah Kamu Yakin?"
                                                                data-confirm-yes="submitDel(<?= $assignApproved->assign_approve_id ?>)"
                                                                data-id="del-{{ $assignApproved->assign_approve_id }}">
                                                                <i class="fas fa-times"> </i> Delete </button>
                                                        </form>


                                                        <button class="btn btn-sm btn-info btn-icon toggle-details ml-2"
                                                            data-target="#details-{{ $assignApproved->assign_approve_id }}">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="details-{{ $assignApproved->assign_approve_id }}"
                                                style="display: none;">
                                                <td colspan="10">

                                                    <h6>Data Perusahaan</h6>
                                                    <table class="table table-bordered table-md">
                                                        <tr>
                                                            <th>Nama Perusahaan</th>
                                                            <th>Kbli</th>
                                                            <th>Judul Kbli</th>
                                                            <th>Sektor</th>
                                                            <th>Kode Proyek</th>
                                                            <th>NPWP</th>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $assignApproved->nama_perusahaan }}</td>
                                                            <td>{{ $assignApproved->kbli }}</td>
                                                            <td>{{ $assignApproved->judul_kbli }}</td>
                                                            <td>{{ $assignApproved->sektor }}</td>
                                                            <td>{{ $assignApproved->kode_proyek }}</td>
                                                            <td>{{ $assignApproved->npwp }}</td>
                                                        </tr>
                                                    </table>
                                                    <br />
                                                    <h6>Data Usaha</h6>
                                                    <table class="table table-bordered table-md">
                                                        <tr>
                                                            <th>Profile Pengusaha</th>
                                                            <th>Alamat</th>
                                                            <th>Kabupaten</th>
                                                            <th>Kecamatan</th>
                                                            <th>Kelurahan</th>
                                                            <th>Longtitude</th>
                                                            <th>Latitude</th>

                                                        </tr>
                                                        <tr>
                                                            <td>{{ $assignApproved->nama_pengusaha }}</td>
                                                            <td>{{ $assignApproved->alamat }}</td>
                                                            <td>{{ $assignApproved->nama_kabupaten }}</td>
                                                            <td>{{ $assignApproved->nama_kecamatan }} </td>
                                                            <td>{{ $assignApproved->nama_kelurahan }}</td>
                                                            <td>{{ $assignApproved->longtitude }}</td>
                                                            <td>{{ $assignApproved->latitude }}</td>
                                                        </tr>
                                                    </table>
                                                    <br />

                                                    <h6>Data Longtitude Latitude Mobile</h6>
                                                    <table class="table table-bordered table-md">
                                                        <tr>
                                                            <th>Longtitude</th>
                                                            <th>Latitude</th>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $assignApproved->longtitude_json }}</td>
                                                            <td>{{ $assignApproved->latitude_json }}</td>
                                                        </tr>

                                                    </table>
                                                    <br />

                                                    <h6>Gambar Usaha</h6>
                                                    <table class="table table-bordered table-md">
                                                        <tr>
                                                            <th>Gambar</th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                @if ($assignApproved->gambar)
                                                                    @php
                                                                        $gambarPaths = explode(', ', $assignApproved->gambar);
                                                                    @endphp
                                                                    <div>
                                                                        <h3>Gambar Utama</h3>
                                                                        @foreach ($gambarPaths as $gambarPath)
                                                                            @php
                                                                                $gambar = \App\Models\Gambar::where('path', $gambarPath)->first();
                                                                            @endphp
                                                                            @if ($gambar && $gambar->star == 1)
                                                                                <img src="{{ Storage::url($gambarPath) }}"
                                                                                    width="200">
                                                                            @endif
                                                                        @endforeach
                                                                    </div>

                                                                    <div>
                                                                        <h3>Gambar Sampingan</h3>
                                                                        @foreach ($gambarPaths as $gambarPath)
                                                                            @php
                                                                                $gambar = \App\Models\Gambar::where('path', $gambarPath)->first();
                                                                            @endphp
                                                                            @if ($gambar && $gambar->star == 0)
                                                                                <img src="{{ Storage::url($gambarPath) }}"
                                                                                    width="100">
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <p>Tidak Ada Gambar</p>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <br />

                                                    <h6>Data Gambar Mobile</h6>
                                                    <table class="table table-bordered table-md">
                                                        <tr>
                                                            <th>Gambar</th>
                                                        </tr>

                                                        <tr>
                                                            <td><img src="{{ asset('storage/assets/img/api/' . $assignApproved->gambar_json) }}"
                                                                    alt="{{ $assignApproved->nama_perusahaan_json }}"
                                                                    width="100">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <br />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {{ $assignApprove->withQueryString()->links() }}

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

        function submitVeri(id) {
            $('#vel-' + id).submit()
        }

        function submitReject(id) {
            $('#vel-reject-' + id).submit()
        }
    </script>
    <script>
        $(document).ready(function() {
            var detailStatus = {};
            $('.toggle-details').click(function() {
                var targetId = $(this).data('target');
                var AssignApproveId = targetId.split('-')[1];

                for (var id in detailStatus) {
                    if (id != AssignApproveId && detailStatus[id] === true) {
                        $('#details-' + id).toggle();
                        $('.toggle-details[data-target="#details-' + id + '"] i')
                            .toggleClass('fa-chevron-down fa-chevron-up');
                        detailStatus[id] = false;
                    }
                }

                $(targetId).toggle();
                $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
                detailStatus[AssignApproveId] = $(targetId).is(':visible');
            });
        });
    </script>
@endpush
@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
