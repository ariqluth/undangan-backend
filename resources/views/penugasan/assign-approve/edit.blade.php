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
            <h2 class="section-title">Edit Penugasan</h2>
            <div class="card">
                <div class="card-header">
                    <h4>Validasi Edit Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('assign-approve.update', $assignApprove) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="assign_to">Nama Petugas</label>
                            <select class="form-control select2 @error('assign_to') is-invalid @enderror" name="assign_to"
                                data-id="select-user-id" id="assign_to">
                                <option value="">Pilih Nama Petugas</option>
                                @foreach ($user as $listUser)
                                    <option @selected($assignApprove->assign_to == $listUser->id) value="{{ $listUser->id }}">
                                        {{ $listUser->name }}</option>
                                @endforeach
                            </select>
                            @error('assign_to')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="perusahaan_id">Nama Perusahaan</label>
                            <select class="form-control select2 @error('perusahaan_id') is-invalid @enderror"
                                name="perusahaan_id" data-id="select-user-id" id="perusahaan_id">
                                <option value="">Pilih Perusahaan</option>
                                @foreach ($perusahaan as $listPerusahaan)
                                    <option @selected($perusahaanSelected == $listPerusahaan->id) value="{{ $listPerusahaan->id }}">
                                        {{ $listPerusahaan->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                            @error('perusahaan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group kbli-form-group">
                            <label>Kbli</label>
                            <select class="form-control select2 @error('kbli_perusahaan_id') is-invalid @enderror"
                                name="kbli_perusahaan_id" data-id="select-kbli_perusahaan_id" id="kbli_perusahaan_id">
                                <option value="">Pilih Kbli Perusahaan</option>
                            </select>
                            @error('kbli_perusahaan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" data-id="submit-perusahaan">Submit</button>
                            <a class="btn btn-secondary" href="{{ route('assign-approve.index') }}">Cancel</a>
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
            $('#perusahaan_id').change(function() {
                if ($(this).val() == '') {
                    $('#kbli_perusahaan_id').attr('disabled', true);
                } else {
                    $('#kbli_perusahaan_id').removeAttr('disabled', false);
                }
                let perusahaan_id = $(this).val();
                var selectKbliPerusahaan = "{{ $kbliPerusahaan }}"
                var dataKbliPerusahaanFilter = JSON.parse(selectKbliPerusahaan.replace(/&quot;/g, '"'));
                $('#kbli_perusahaan_id').empty();

                $.ajax({
                    url: '{{ route('kbliperusahaanfilter.filter') }}',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id: perusahaan_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                        $('#kbli_perusahaan_id').html(
                            '<option value="">Pilih Kbli Perusahaan</option>');
                        $.each(response['KbliPerusahaan'], function(index, val) {
                            console.log('<option value="' + val.kbli_perusahaan_id +
                                '"> ' + val
                                .kbli + val.judul_kbli + val.sektor +
                                ' </option>'
                            );
                            $('#kbli_perusahaan_id').append('<option value="' + val
                                .kbli_perusahaan_id +
                                '"> ' + val
                                .kbli + " - " + val.judul_kbli + " - " + val
                                .sektor +
                                ' </option>'
                            );
                        });
                    }
                });
            });

            let perusahaan_id = $(this).val();
            var selectKbliPerusahaan = "{{ $kbliPerusahaan }}"
            var dataKbliPerusahaanFilter = JSON.parse(selectKbliPerusahaan.replace(/&quot;/g, '"'));
            var selectedPerusahaanId = ({{ $perusahaanSelected }});
            $.ajax({
                url: '{{ route('kbliperusahaanfiltered.filter') }}',
                type: 'get',
                data: {
                    id: selectedPerusahaanId
                },
                success: function(response) {

                    $('#kbli_perusahaan_id').empty();
                    var KbliPerusahaanHTML = $('#kbli_perusahaan_id');
                    KbliPerusahaanHTML.empty();
                    $.each(response['KbliPerusahaan'], function(index, val) {
                        console.log(val);

                        if (val.perusahaan_id == selectedPerusahaanId) {
                            console.log('<option value="' + val
                                .kbli_perusahaan_id +
                                '"> ' + val
                                .kbli + " - " + val.judul_kbli + " - " + val
                                .sektor +
                                ' </option>'
                            );
                            $("#kbli_perusahaan_id option[value='" + val.kbli_perusahaan_id +
                                "']").attr(
                                "selected", "selected");
                            KbliPerusahaanHTML.append('<option value="' + val
                                .kbli_perusahaan_id +
                                '"> ' + val
                                .kbli + " - " + val.judul_kbli + " - " + val
                                .sektor +
                                ' </option>'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
