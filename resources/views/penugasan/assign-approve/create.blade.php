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
            <h2 class="section-title">Tambah Penugasan</h2>
            <div class="card">
                <div class="card-header">
                    <h4>Validasi Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('assign-approve.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="assign_to">Nama Petugas</label>
                            <select class="form-control select2 @error('assign_to') is-invalid @enderror" name="assign_to"
                                data-id="select-user-id" id="assign_to">
                                <option value="">Pilih Nama Petugas</option>
                                @foreach ($user as $listUser)
                                    <option value="{{ $listUser->id }}">
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
                                name="kbli_perusahaan_id" data-id="select-kbli_perusahaan_id" id="kbli_perusahaan_id"
                                disabled="disabled">
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

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
    <style>
        .select2-dropdown .select2-results__options {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
@endpush

@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#perusahaan_id').select2({
                placeholder: "   Pilih Nama Perusahaan",
                allowClear: true,
                ajax: {
                    url: '{{ url('/api/perusahaan') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        console.log(params.term)
                        return {
                            q: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        var matchedResults = [];
                        var term = params.term.toLowerCase();

                        data.data.forEach(function(result) {
                            var namaPerusahaan = result.nama_perusahaan
                                .toLowerCase();

                            if (namaPerusahaan.includes(term)) {
                                matchedResults.push(result);
                            }
                        });

                        return {
                            results: matchedResults,
                            pagination: {
                                more: (params.page * data.meta.per_page) < data.meta.total
                            }
                        };
                    },

                    cache: true
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            function formatRepo(repo) {
                if (repo.loading) {
                    return repo.text;
                }

                var markup = "<div class='select2-result-repository__description'>" + repo.nama_perusahaan +
                    "</div>";

                return markup;
            }

            function formatRepoSelection(repo) {
                return repo.nama_perusahaan || repo.text;
            }
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            let delayTimer;

            $('#perusahaan_id').change(function() {
                if (delayTimer) {
                    clearTimeout(delayTimer);
                }
                delayTimer = setTimeout(function() {
                    if ($('#perusahaan_id').val() == '') {
                        $('#kbli_perusahaan_id').attr('disabled', true);
                    } else {
                        $('#kbli_perusahaan_id').removeAttr('disabled', false);
                    }
                    let perusahaan_id = $('#perusahaan_id').val();
                  
                    $.ajax({
                        url: '{{ url('api/kbliperusahaansearch') }}',
                        method: 'get',
                        dataType: 'json',
                        data: {
                            id: perusahaan_id,
                           
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            console.log(data);
                            $('#kbli_perusahaan_id').html(
                                '<option value="">Pilih Kbli Perusahaan</option>');
                            $.each(data['KbliPerusahaan'], function(index, val) {
                                console.log(val);
                                console.log('<option value="' + val
                                    .kbli_perusahaan_id +
                                    '"> ' + val
                                    .kbli + val.judul_kbli + val.sektor +
                                    ' </option>'
                                );
                                $('#kbli_perusahaan_id').append(
                                    '<option value="' + val
                                    .kbli_perusahaan_id +
                                    '"> ' + val
                                    .kbli + " - " + val.judul_kbli + " - " +
                                    val
                                    .sektor +
                                    ' </option>'
                                );
                            });
                        }
                    });
                }, 400);
            });
        });
    </script>
@endpush
