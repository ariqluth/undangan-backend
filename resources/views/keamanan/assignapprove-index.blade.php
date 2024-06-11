@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Security Assign Approve</h1>
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
                            <h4>List Penugasan</h4>
                            <div class="card-header-action">
                                <a class="btn btn-info btn-primary active search" data-id="search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Penugasan</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="">
                                    {{-- <div class="form-col">
                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="role">Nama Perusahaan</label>
                                                <input type="text" name="nama_perusahaan" class="form-control"
                                                    id="nama_perusahaan" placeholder="Nama Perusahaan"
                                                    data-id="search-perusahaan" value="{{ $nama_perusahaan }}">
                                            </div>
                                        </div>
                                    </div> --}}
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
                                                            <td>{{ $assignApproved->created_at }}</td>
                                                            <td>{{ $assignApproved->created_by_name }}</td>
                                                            <td>{{ $assignApproved->updated_at }}</td>
                                                            <td>{{ $assignApproved->updated_by_name }}</td>
                                                            <td>{{ $assignApproved->data_terhapus }}</td>
                                                            <td>{{ $assignApproved->delete_by_name }}</td>
                                                            <td>{{ $assignApproved->delete_at }}</td>
                                                        </tr>
                                                    </table>
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
