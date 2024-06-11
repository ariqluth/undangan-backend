@extends('layouts.app2')

@section('contentvisitor')
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
                <div class="col-12  col-lg-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Geo Location UMKM</h4>
                            <div class="card-header-action">
                            </div>
                        </div>
                        <form id="search" method="GET" action="">
                            <div class="card" style="position: relative;  z-index: 0;">
                                <div class="card-body" id="cardP">
                                    <div class="section-title-secondary">Nama Pengusaha</div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama_pengusaha" name="nama_pengusaha"
                                            placeholder="Nama Pengusaha" data-id="search-pengusaha"
                                            value="{{ $nama_pengusaha }}">
                                    </div>
                                    <div class="section-title-secondary">Nama Perusahaan</div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama_perusahaan"
                                            name="nama_perusahaan" placeholder="Nama Perusahaan" data-id="search-perusahaan"
                                            value="{{ $nama_perusahaan }}">
                                    </div>
                                    <div class="section-title-secondary">Kecamatan</div>
                                    <div class="form-group">
                                        <select class="form-control select2" name="kecamatan[]" multiple
                                            data-id="select-Kecamatan" id="kecamatan">
                                            @foreach ($kecamatans as $kecamatan)
                                                <option value="{{ $kecamatan->id }}"
                                                    {{ (is_array(old('kecamatan')) && in_array($kecamatan->id, old('kecamatan'))) || (isset($kecamatanSelected) && in_array($kecamatan->id, $kecamatanSelected)) ? 'selected' : '' }}>
                                                    {{ $kecamatan->nama_kecamatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="section-title-secondary">Kelurahan</div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select class="form-control select2 kelurahan" name="kelurahan[]" multiple
                                                data-id="select-kelurahan" id="kelurahan">
                                                @foreach ($kelurahans as $kelurahan)
                                                    <option value="{{ $kelurahan->id }}"
                                                        {{ (is_array(old('kelurahan')) && in_array($kelurahan->id, old('kelurahan'))) || (isset($kelurahanSelected) && in_array($kelurahan->id, $kelurahanSelected)) ? 'selected' : '' }}>
                                                        {{ $kelurahan->nama_kelurahan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="section-title-secondary">Kbli</div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select class="form-control select2" name="kbli[]" multiple
                                                data-id="select-kbli" id="kbli"
                                                style="display: flex;
                                            flex-wrap: wrap;
                                            align-items: center;">
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

                                    <div class="section-title-secondary">Alamat</div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="alamat" id="alamat"
                                            placeholder="Alamat Usaha" value="{{ $alamat }}">
                                    </div>
                                    <div class="text-right">

                                        <button class="btn btn-primary mr-1 button" type="submit" data-id="submit-search"
                                            id="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12  col-lg-5">
                    <div class="card-body" id="render-map1" style="height: 790px;width: 650px; z-index: 1;">
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card">
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
                                                    <button class="btn btn-sm btn-primary btn-icon"
                                                        data-kbli="{{ $kbliperusahaan->kbli }}"
                                                        data-judulkbli="{{ $kbliperusahaan->judul_kbli }}"
                                                        data-sektor="{{ $kbliperusahaan->sektor }}"
                                                        data-latitude="{{ $kbliperusahaan->latitude }}"
                                                        data-longitude="{{ $kbliperusahaan->longtitude }}"
                                                        data-kecamatan="{{ $kbliperusahaan->nama_kecamatan }}"
                                                        data-kelurahan="{{ $kbliperusahaan->nama_kelurahan }}"
                                                        data-perusahaan="{{ $kbliperusahaan->nama_perusahaan }}"
                                                        data-pengusaha="{{ $kbliperusahaan->nama_pengusaha }}"
                                                        data-alamat="{{ $kbliperusahaan->alamat }}"
                                                        data-jenis="{{ $kbliperusahaan->nama_uraian_jenis_perusahaan }}"
                                                        data-resiko="{{ $kbliperusahaan->nama_uraian_resiko_proyek }}"
                                                        data-skala="{{ $kbliperusahaan->nama_uraian_skala_usaha }}"
                                                        data-gambar="{{ $kbliperusahaan->gambar }}"
                                                        onclick="showDetailOnMap(event)">Detail</button>

                                                    <button class="btn btn-sm btn-info btn-icon toggle-details"
                                                        data-target="#details-{{ $kbliperusahaan->kbliperusahaan_Id }}">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="details-{{ $kbliperusahaan->kbliperusahaan_Id }}" style="display: none;">
                                            <td colspan="10">
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
                                                        <td>{{ $kbliperusahaan->nama_pengusaha }}</td>
                                                        <td>{{ $kbliperusahaan->alamat }}</td>
                                                        <td>{{ $kbliperusahaan->nama_kabupaten }}</td>
                                                        <td>{{ $kbliperusahaan->nama_kecamatan }} </td>
                                                        <td>{{ $kbliperusahaan->nama_kelurahan }}</td>
                                                        <td>{{ substr($kbliperusahaan->longtitude, 0, 8) }}</td>
                                                        <td>{{ substr($kbliperusahaan->latitude, 0, 8) }}</td>
                                                    </tr>
                                                </table>
                                                <br />
                                                <h6>Status Usaha</h6>
                                                <table class="table table-bordered table-md">
                                                    <tr>
                                                        <th>PMDN</th>
                                                        <th>Uraian Jenis Perusahaan</th>
                                                        <th>Uraian Resiko Proyek</th>
                                                        <th>Uraian Skala Usaha</th>
                                                        <th>Gambar</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $kbliperusahaan->status_pmdn }}</td>
                                                        <td>{{ $kbliperusahaan->nama_uraian_jenis_perusahaan }} </td>
                                                        <td>{{ $kbliperusahaan->nama_uraian_resiko_proyek }}</td>
                                                        <td>{{ $kbliperusahaan->nama_uraian_skala_usaha }}</td>
                                                        <td>
                                                            @if ($kbliperusahaan->gambar)
                                                                @php
                                                                    $gambarPaths = explode(', ', $kbliperusahaan->gambar);
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

                                                <h6>Detail Total Pembiayaan</h6>
                                                <table class="table table-bordered table-md">
                                                    <tr>
                                                        <th>Mesin Peralatan</th>
                                                        <th>Mesin Peralatan Impor</th>
                                                        <th>Pembelian Pematangan Tanah</th>
                                                        <th>Bangunan Gedung</th>
                                                        <th>Modal Kerja</th>
                                                        <th>Lain-Lain</th>
                                                        <th>Jumlah Investasi</th>
                                                        <th>Tenaga Kerja</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $kbliperusahaan->mesin_peralatan }}</td>
                                                        <td>{{ $kbliperusahaan->mesin_peralatan_impor }}
                                                        </td>
                                                        <td>{{ $kbliperusahaan->pembelian_pematangan_tanah }}
                                                        </td>
                                                        <td>{{ $kbliperusahaan->bangunan_gedung }}</td>
                                                        <td>{{ $kbliperusahaan->modal_kerja }}</td>
                                                        <td>{{ $kbliperusahaan->lain_lain }}</td>
                                                        <td>{{ $kbliperusahaan->jumlah_investasi }}</td>
                                                        <td>{{ $kbliperusahaan->tenaga_kerja }}</td>
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
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            display: flex;
            flex-wrap: wrap;
            max-height: none;
            align-items: flex-start;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            display: block;
            width: 100%;
            margin-bottom: 5px;
        }
    </style>
@endsection
@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kecamatan').select2({
                placeholder: "   Pilih Kecamatan",
                allowClear: true,
                ajax: {
                    url: '{{ url('/api/kecamatan') }}',
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
                            var namaKecamatan = result.nama_kecamatan
                                .toLowerCase();

                            if (namaKecamatan.includes(term)) {
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

                var markup = "<div class='select2-result-repository__description'>" + repo.nama_kecamatan +
                    "</div>";

                return markup;
            }

            function formatRepoSelection(repo) {
                return repo.nama_kecamatan || repo.text;
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#kelurahan').select2({
                placeholder: "   Pilih Kelurahan",
                allowClear: true,
                ajax: {
                    url: '{{ url('/api/kelurahan') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
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
                            var namaKelurahan = result.nama_kelurahan
                                .toLowerCase();

                            if (namaKelurahan.includes(term)) {
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

                var markup = "<div class='select2-result-repository__description'>" + repo.nama_kelurahan +
                    "</div>";

                return markup;
            }

            function formatRepoSelection(repo) {
                return repo.nama_kelurahan || repo.text;
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#kbli').select2({
                placeholder: "  Pilih KBLI",
                allowClear: true,
                ajax: {
                    url: '{{ url('/api/kblisearch') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
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
                            var kbli = result.kbli
                                .toLowerCase();
                            var judulKbli = result.judul_kbli
                                .toLowerCase();
                            var sektor = result.sektor
                                .toLowerCase();

                            if (kbli.includes(term)) {
                                matchedResults.push(result);
                            }
                            if (judulKbli.includes(term)) {
                                matchedResults.push(result);
                            }
                            if (sektor.includes(term)) {
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
                if (repo.loading) return repo.text;
                var markup = "<div class='select2-result-repository__description'>" + repo.kbli + " - " + repo
                    .judul_kbli + " - " + repo.sektor + "</div>";
                return markup;
            }

            function formatRepoSelection(repo) {
                return repo.kbli + repo.judul_kbli + repo.sektor || repo.text;
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            var detailStatus = {};
            $('.form-control select2 kelurahan').select2();
            $('#kecamatan').change(function() {
                var kecamatanIds = $(this).val();
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
        });
        $('.toggle-details').click(function() {
            let cardP = document.getElementById('cardP')
            event.stopPropagation();
            cardP.style.display = 'block';
            $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
        });
        $(document).on('click', '.select2-selection__choice', function() {
            var choice = $(this);
            var container = choice.closest('.select2-container');
            var selection = container.find('.select2-selection--multiple');
            var offset = selection.offset().left;
            var choiceOffset = choice.offset().left;
            var choiceWidth = choice.width();
            var containerWidth = container.width();
            var diff = choiceOffset - offset + choiceWidth + 10;
            var maxWidth = containerWidth - diff;
            choice.css({
                'max-width': maxWidth
            });
        });
    </script>
    <script>
        let map;
        let restaurantIcon;
        let BookIcon;
        let HotelIcon;
        let GedungIcon;
        let ShopingIcon;
        let PantaiIcon;

        function showDetailOnMap(event) {
            const latitude = parseFloat(event.target.getAttribute('data-latitude'));
            const longitude = parseFloat(event.target.getAttribute('data-longitude'));
            const kbli = event.target.getAttribute('data-kbli');
            const judulkbli = event.target.getAttribute('data-judulkbli');
            const sektor = event.target.getAttribute('data-sektor');
            const gambar = event.target.getAttribute('data-gambar');
            const perusahaan = event.target.getAttribute('data-perusahaan');
            const pengusaha = event.target.getAttribute('data-pengusaha');
            const kecamatan = event.target.getAttribute('data-kecamatan');
            const kelurahan = event.target.getAttribute('data-kelurahan');
            const alamat = event.target.getAttribute('data-alamat');
            const jenis = event.target.getAttribute('data-jenis');
            const resiko = event.target.getAttribute('data-resiko');
            const skala = event.target.getAttribute('data-skala');

            map.closePopup();

            const customIcon = getCustomIcon(kbli);

            let popupContent = '';
            let gambars = gambar ? `{{ Storage::url('${gambar}') }}` : "/assets/img/default.jpg";

            if (gambars) {
                popupContent +=
                    `<img src="${gambars}" style='width:100px;height:100px;display:block;margin:0 auto;'> <br>`;
            }


            popupContent += `
        <strong>Nama Perusahaan:</strong> ${perusahaan || 'N/A'}<br>
        <strong>Nama Pengusaha:</strong> ${pengusaha || 'N/A'}<br>
        <strong>Jenis Perusahaan:</strong> ${jenis || 'N/A'}<br>
        <strong>Resiko Perusahaan:</strong> ${resiko || 'N/A'}<br>
        <strong>Skala Usaha:</strong> ${skala || 'N/A'}<br>
        <strong>Kbli:</strong> ${kbli || 'N/A'}-${judulkbli || 'N/A'}-${sektor || 'N/A'}<br>`;


            if (!isNaN(latitude) && !isNaN(longitude)) {
                if (customIcon) {
                    const marker = L.marker([latitude, longitude], {
                        icon: customIcon
                    });
                    marker.addTo(map);
                    marker.bindPopup(popupContent);
                    marker.openPopup();
                    map.setView(new L.LatLng(latitude, longitude), 18);
                } else {
                    const marker = L.marker([latitude, longitude]);
                    marker.addTo(map);
                    marker.bindPopup(popupContent);
                    marker.openPopup();
                    map.setView(new L.LatLng(latitude, longitude), 18);
                }
            } else {
                alert('No data available.');
            }

            const markerOptions = {};
            if (customIcon) {
                markerOptions.icon = customIcon;
            }

            const marker = L.marker([latitude || 0, longitude || 0],
                markerOptions);
            marker.addTo(map);
            marker.bindPopup(popupContent);
            marker.openPopup();
        }

        function getCustomIcon(kbli) {
            const iconMapping = {
                restaurant: ["56102", "10779", "11040", "10391", "10794", "10792",
                    "10799", "10399", "10710", "10761",
                    "21022", "10772", "56103", "56304", "01261",
                    "10212", "10793", "10740", "56101", "56303",
                    "10750",
                    "11090", "01461", "56109", "47991", "47249", "46339", "56301"
                ],
                book: ["85133", "85132", "85139", "85491", "85492", "85121", "85220", "85493", "85497",
                    "85498", "85134", "85321", "85322", "85240", "85500", "85420", "85495", "85122", "85440",
                    "85142", "85141", "85499",
                    "85410"
                ],
                hotel: ["55120", "55110", "55194"],
                gedung: ["41016", "41015", "31001", "82301", "14111", "16299", "16299", "10631", "10330",
                    "16101",
                ],
                shoping: ["47612", "47630", "47591", "47592", "47241", "47212", "47213", "47219", "47411",
                    "01285", "47420", "47752",
                    "47762", "47611", "47599", "47112", "45302", "47711", "47301", "47521", "47524", "47526",
                    "47796", "47793",
                    "47111", "47725", "47243", "47242", "47215", "47721", "47772", "45104", "45404", "47530",
                    "47192", "47529", "47528",
                    "47597", "47919", "47772", "47881", "47913", "47415", "46100", "47912", "47913", "47303",
                    "47211", "47754", "47741", "47511",
                    "47245", "47243", "47593", "47530", "47882", "47216", "47789", "47999", "47753", "47761",
                    "47414", "47111", "47724", "47735", "47920", "47914", "47214", '47733'
                ],
                pantai: ["93224", "30112"],
            };
            if (iconMapping.restaurant.includes(kbli)) {
                icon = restaurantIcon;
            } else if (iconMapping.book.includes(kbli)) {
                icon = BookIcon;
            } else if (iconMapping.hotel.includes(kbli)) {
                icon = HotelIcon;
            } else if (iconMapping.gedung.includes(kbli)) {
                icon = GedungIcon;
            } else if (iconMapping.shoping.includes(kbli)) {
                icon = ShopingIcon;
            } else if (iconMapping.pantai.includes(kbli)) {
                icon = PantaiIcon;
            } else {
                icon = null;
            }

            return icon;
        }

        const mapElement = document.getElementById("render-map1")

        const defaultCoord = [-8.1115339, 111.1627972]
        map = L.map(mapElement)
        const osmTileUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        const attrib = 'Leaflet with <a href="https://academy.byidmore.com">Id More Academy<a>'
        const osmTile = new L.TileLayer(osmTileUrl, {
            minZoom: 2,
            attribution: attrib
        })
        map.setView(new L.LatLng(defaultCoord[0], defaultCoord[1]), 10)
        map.addLayer(osmTile)
        const markers = {}

        restaurantIcon = L.icon({
            iconUrl: '{{ asset('assets/img/restaurant-icon.png') }}',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        })

        BookIcon = L.icon({
            iconUrl: '{{ asset('assets/img/book-icon.png') }}',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        })

        HotelIcon = L.icon({
            iconUrl: '{{ asset('assets/img/hotel-icon.png') }}',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        })

        GedungIcon = L.icon({
            iconUrl: '{{ asset('assets/img/gedung-icon.png') }}',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        })

        ShopingIcon = L.icon({
            iconUrl: '{{ asset('assets/img/shoping-icon.png') }}',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        })

        PantaiIcon = L.icon({
            iconUrl: '{{ asset('assets/img/beach-icon.png') }}',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        })

        let markersData = [];
        const companies = [];

        let namaPengusahaInputs = document.getElementById('nama_pengusaha').value;
        let namaPerusahaanInputs = document.getElementById('nama_perusahaan').value;
        let alamatInputs = document.getElementById('alamat').value;
        let kelurahanInputs = document.getElementById('kelurahan').value;
        let kecamatanInputs = document.getElementById('kecamatan').value;
        let kbliInputs = document.getElementById('kbli').value;


        let queryParamss = [];

        if (namaPengusahaInputs) {
            queryParamss.push(`nama_pengusaha=${namaPengusahaInputs}`);
        }
        if (namaPerusahaanInputs) {
            queryParamss.push(`nama_perusahaan=${namaPerusahaanInputs}`);
        }
        if (alamatInputs) {
            queryParamss.push(`alamat=${alamatInputs}`);
        }
        if (kelurahanInputs) {
            queryParamss.push(`kelurahan%5B%5D=${kelurahanInputs}`);
        }
        if (kecamatanInputs) {
            queryParamss.push(`kecamatan%5B%5D=${kecamatanInputs}`);
        }
        if (kbliInputs) {
            queryParamss.push(`kbli%5B%5D=${kbliInputs}`);

        }

        let searchURLs = `/api/visitormap?${queryParamss.join('&')}`;

        // console.log(kecamatanInput);

        fetch(searchURLs)
            // fetch('{{ url('/api/visitormap') }}')
            .then(response => response.json())
            .then(responseData => {
                if (Array.isArray(responseData.data)) {
                    const markersData = responseData.data;

                    addGeoJsonLayer('assets/js/pacitanJson.json', pacitanLayer, markersData);
                    addGeoJsonLayer('assets/js/pringkukuJson.json', pringkukuLayer, markersData);
                    addGeoJsonLayer('assets/js/nawanganJson.json', nawanganLayer, markersData);
                    addGeoJsonLayer('assets/js/donorojoJson.json', donorojoLayer, markersData);
                    addGeoJsonLayer('assets/js/keboagungJson.json', keboagungLayer, markersData);
                    addGeoJsonLayer('assets/js/punungJson.json', punungLayer, markersData);
                    addGeoJsonLayer('assets/js/arjosariJson.json', arjosariLayer, markersData);
                    addGeoJsonLayer('assets/js/sudimoroJson.json', sudimoroLayer, markersData);
                    addGeoJsonLayer('assets/js/tulakanJson.json', tulakanLayer, markersData);
                    addGeoJsonLayer('assets/js/tegalomboJson.json', tegalomboLayer, markersData);
                    addGeoJsonLayer('assets/js/bandarJson.json', bandarLayer, markersData);
                    addGeoJsonLayer('assets/js/ngadirejoJson.json', ngadirejoLayer, markersData);
                } else {
                    console.error('Data is not an array');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });

        function countCompaniesInArea(areaData, companies) {
            let count = 0;
            // console.log('Area data:', JSON.stringify(areaData));
            for (const company of companies) {
                if (company.longitude && company.latitude) {
                    const point = turf.point([parseFloat(company.longitude), parseFloat(company.latitude)]);
                    // console.log('Checking point:', point);
                    if (turf.booleanPointInPolygon(point, areaData.geometry)) {
                        count++;

                    } else {

                    }
                } else {

                }
            }
            return count;
        }



        function updateStyle(areaData, companies) {
            const count = countCompaniesInArea(areaData, companies);
            // console.log(count);

            let fillColor;
            if (count > 50) {
                fillColor = '#9384D1';
            } else if (count > 35) {
                fillColor = '#C9A7EB';
            } else if (count == 15) {
                fillColor = '#ECC9EE';
            } else {
                fillColor = '#FFDCB6';
            }

            return {
                color: 'blue',
                weight: 2,
                opacity: 0.7,
                fillColor: fillColor,
                fillOpacity: 0.3
            };
        }


        let icon

        let existingMarker
        let marker;
        let makerss;
        const restaurantMarkers = L.layerGroup();

        const bookMarkers = L.layerGroup();
        const hotelMarkers = L.layerGroup();
        const gedungMarkers = L.layerGroup();
        const shopingMarkers = L.layerGroup();
        const pantaiMarkers = L.layerGroup();
        const noIconMarkers = L.layerGroup();

        const pacitanLayer = L.layerGroup();
        const pringkukuLayer = L.layerGroup();
        const nawanganLayer = L.layerGroup();
        const donorojoLayer = L.layerGroup();
        const keboagungLayer = L.layerGroup();
        const punungLayer = L.layerGroup();
        const arjosariLayer = L.layerGroup();
        const sudimoroLayer = L.layerGroup();
        const tulakanLayer = L.layerGroup();
        const tegalomboLayer = L.layerGroup();
        const bandarLayer = L.layerGroup();
        const ngadirejoLayer = L.layerGroup();

        function toggleAllLayers(enable) {
            const layers = [
                pacitanLayer,
                pringkukuLayer,
                nawanganLayer,
                donorojoLayer,
                keboagungLayer,
                punungLayer,
                arjosariLayer,
                sudimoroLayer,
                tulakanLayer,
                tegalomboLayer,
                bandarLayer,
                ngadirejoLayer,
            ];

            layers.forEach(layer => {
                if (enable) {
                    layer.addTo(map);
                } else {
                    layer.removeFrom(map);
                }
            });
        }

        const toggleAllControl = L.Control.extend({
            options: {
                position: 'topleft'
            },

            onAdd: function(map) {
                const container = L.DomUtil.create('div',
                    'leaflet-bar leaflet-control leaflet-control-custom');

                const img = document.createElement('img');
                img.src =
                    '../assets/img/pacitan/collor-pallet.png';
                img.style.width = '100%';
                img.style.height = '100%';
                container.appendChild(img);


                container.style.backgroundColor = 'white';
                container.style.width = '250px';
                container.style.height = '35px';
                container.style.textAlign = 'center';
                container.style.lineHeight = '10px';
                container.style.cursor = 'pointer';

                container.onclick = function() {
                    // Cek apakah layer pertama (pacitanLayer) ada di peta untuk menentukan apakah layer aktif atau tidak
                    const enable = !map.hasLayer(pacitanLayer);
                    toggleAllLayers(enable);
                };

                return container;
            }
        });

        map.addControl(new toggleAllControl());

        let namaPengusahaInput = document.getElementById('nama_pengusaha').value;
        let namaPerusahaanInput = document.getElementById('nama_perusahaan').value;
        let alamatInput = document.getElementById('alamat').value;
        let kelurahanInput = document.getElementById('kelurahan');
        let selectedKelurahan = Array.from(kelurahanInput.selectedOptions).map(option => option.value);
        let kecamatanInput = document.getElementById('kecamatan');
        let selectedKecamatan = Array.from(kecamatanInput.selectedOptions).map(option => option.value);

        let kbliInput = document.getElementById('kbli');
        let selectedKbli = Array.from(kbliInput.selectedOptions).map(option => option.value);

        let queryParams = [];

        if (namaPengusahaInput) {
            queryParams.push(`nama_pengusaha=${namaPengusahaInput}`);
        }
        if (namaPerusahaanInput) {
            queryParams.push(`nama_perusahaan=${namaPerusahaanInput}`);
        }
        if (alamatInput) {
            queryParams.push(`alamat=${alamatInput}`);
        }
        if (selectedKelurahan.length) {
            queryParams.push(`kelurahan[]=${selectedKelurahan.join(',')}`);
        }
        if (selectedKecamatan.length) {
            queryParams.push(`kecamatan[]=${selectedKecamatan.join(',')}`);
        }
        if (selectedKbli.length) {
            queryParams.push(`kbli[]=${selectedKbli.join(',')}`);
        }

        let searchURL = `/api/map?${queryParams.join('&')}`;



        fetch(searchURL)
            .then(response => response.json())
            .then(responseData => {
                if (Array.isArray(responseData.data)) {
                    responseData.data.forEach(marker => {
                        var latitude = marker.latitude;
                        var longitude = marker.longtitude;
                        var kbli = marker.kbli;

                        companies.push({
                            latitude: latitude,
                            longitude: longitude,
                            kbli: kbli,
                        });

                        if (!latitude || !longitude) {
                            return;
                        }

                        if (["56102", "10779", "11040", "10391", "10794", "10792", "10799", "10399",
                                "10710", "10761",
                                "21022", "10772", "56103", "56304", "01261", "10212", "10793",
                                "10740", "56101", "56303",
                                "10750",
                                "11090", "01461", "56109", "47991", "47249", "46339", "56301"
                            ].includes(kbli)) {
                            icon = restaurantIcon;
                        } else if (["85133", "85132", "85139", "85491", "85492", "85121", "85220",
                                "85493", "85497",
                                "85498", "85134", "85321", "85322", "85240", "85500", "85420",
                                "85495", "85122", "85440",
                                "85142", "85141", "85499",
                                "85410"
                            ].includes(kbli)) {
                            icon = BookIcon;
                        } else if (["55120", "55110", "55194"].includes(kbli)) {
                            icon = HotelIcon;
                        } else if (["41016", "41015", "31001", "82301", "14111", "16299", "16299",
                                "10631", "10330",
                                "16101",
                            ].includes(kbli)) {
                            icon = GedungIcon;
                        } else if (["47612", "47630", "47591", "47592", "47241", "47212", "47213",
                                "47219", "47411",
                                "01285", "47420", "47752",
                                "47762", "47611", "47599", "47112", "45302", "47711", "47301",
                                "47521", "47524", "47526",
                                "47796", "47793",
                                "47111", "47725", "47243", "47242", "47215", "47721", "47772",
                                "45104", "45404", "47530",
                                "47192", "47529", "47528",
                                "47597", "47919", "47772", "47881", "47913", "47415", "46100",
                                "47912", "47913", "47303",
                                "47211", "47754", "47741", "47511",
                                "47245", "47243", "47593", "47530", "47882", "47216", "47789",
                                "47999", "47753", "47761",
                                "47414", "47111", "47724", "47735", "47920", "47914", "47214",
                                '47733'
                            ].includes(kbli)) {
                            icon = ShopingIcon;
                        } else if (["93224", "30112"].includes(kbli)) {
                            icon = PantaiIcon;
                        } else {
                            icon = null;
                        }

                        var customIcon = icon ? icon : L.icon({
                            iconUrl: '{{ asset('assets/img/user.png') }}',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32],
                            popupAnchor: [0, -32]
                        });

                        var newMarker = L.marker([latitude, longitude], {
                            icon: customIcon
                        }).on('click', function() {
                            fetch('/api/popup/' + marker.id)
                                .then(response => response.json())
                                .then(data => {
                                    var alamat = data.alamat !== undefined ? data
                                        .alamat : "Tidak ada data";
                                    var kbli = data.kbli !== undefined ? data.kbli :
                                        "Tidak ada data";
                                    var perusahaan = data.nama_perusahaan !==
                                        undefined ? data.nama_perusahaan :
                                        "Tidak ada data";
                                    var pengusaha = data.nama_pengusaha !==
                                        undefined ? data.nama_pengusaha :
                                        "Tidak ada data";
                                    var uraian_jenis_perusahaan = data
                                        .nama_uraian_jenis_perusahaan !== undefined ?
                                        data.nama_uraian_jenis_perusahaan :
                                        "Tidak ada data";
                                    var uraian_skala_usaha = data
                                        .nama_uraian_skala_usaha !== undefined ? data
                                        .nama_uraian_skala_usaha : "Tidak ada data";
                                    var uraian_resiko_proyek = data
                                        .nama_uraian_resiko_proyek !== undefined ?
                                        data.nama_uraian_resiko_proyek :
                                        "Tidak ada data";
                                    var judul_kbli = data.judul_kbli !== undefined ?
                                        data.judul_kbli : "Tidak ada data";
                                    var sektor = data.sektor !== undefined ? data
                                        .sektor : "Tidak ada data";
                                    var baseUrlWithImage = '{{ Storage::url('') }}';
                                    var baseUrlWithoutImage = '{{ url('') }}';
                                    var gambars;
                                    var additionalImages = '';
                                    var content;

                                    if (data.gambar !== undefined) {
                                        var starredImage = data.gambar.find(img => img.star ===
                                            "1");
                                        if (starredImage !== undefined) {
                                            gambars = starredImage.path;
                                        } else {
                                            gambars = "/assets/img/default.jpg";
                                        }

                                        var otherImages = data.gambar.filter(img => img.star ===
                                            "0");
                                        additionalImages = otherImages.map(img => '<img src="' +
                                            baseUrlWithImage + img.path +
                                            '" style="width:100px;height:100px;display:block;margin:0 auto;"><br>'
                                        ).join('');

                                        content = '<img src="' + baseUrlWithImage + gambars +
                                            '" style="width:100px;height:100px;display:block;margin:0 auto;"><br>' +
                                            additionalImages +
                                            '<b>Nama Perusahaan:</b> ' + perusahaan +
                                            '<br>' +
                                            '<b>Nama Pengusaha:</b> ' + pengusaha + '<br>' +
                                            '<b>Alamat:</b> ' + alamat + '<br>' +
                                            '<b>KBLI:</b> ' + kbli + ' - ' + judul_kbli +
                                            '-' + sektor + '<br>' +
                                            '<b>Uraian Jenis Perusahaan:</b> ' +
                                            uraian_jenis_perusahaan + '<br>' +
                                            '<b>Uraian Skala Usaha:</b> ' + uraian_skala_usaha +
                                            '<br>' +
                                            '<b>Uraian Resiko Proyek:</b> ' + uraian_resiko_proyek;

                                    } else {
                                        gambars = "/assets/img/default.jpg";

                                        content = '<img src="' + baseUrlWithoutImage + gambars +
                                            '" style="width:100px;height:100px;display:block;margin:0 auto;"><br>' +
                                            '<b>Nama Perusahaan:</b> ' + perusahaan +
                                            '<br>' +
                                            '<b>Nama Pengusaha:</b> ' + pengusaha + '<br>' +
                                            '<b>Alamat:</b> ' + alamat + '<br>' +
                                            '<b>KBLI:</b> ' + kbli + ' - ' + judul_kbli +
                                            '-' + sektor + '<br>' +
                                            '<b>Uraian Jenis Perusahaan:</b> ' +
                                            uraian_jenis_perusahaan + '<br>' +
                                            '<b>Uraian Skala Usaha:</b> ' + uraian_skala_usaha +
                                            '<br>' +
                                            '<b>Uraian Resiko Proyek:</b> ' + uraian_resiko_proyek;
                                    }

                                    newMarker.bindPopup(content).openPopup();
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        }).addTo(map);


                        if (icon === restaurantIcon) {
                            restaurantMarkers.addLayer(newMarker);
                        } else if (icon === BookIcon) {
                            bookMarkers.addLayer(newMarker);
                        } else if (icon === HotelIcon) {
                            hotelMarkers.addLayer(newMarker);
                        } else if (icon === GedungIcon) {
                            gedungMarkers.addLayer(newMarker);
                        } else if (icon === ShopingIcon) {
                            shopingMarkers.addLayer(newMarker);
                        } else if (icon === PantaiIcon) {
                            pantaiMarkers.addLayer(newMarker);
                        } else {
                            noIconMarkers.addLayer(newMarker);
                        }
                    });
                } else {
                    console.error('Data is not an array');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });

        // }


        function addGeoJsonLayer(url, layerGroup, companies) {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const geoJsonLayer = L.geoJSON(data, {
                        style: (areaData) => updateStyle(areaData, companies)
                    });
                    geoJsonLayer.addTo(layerGroup);
                })
                .catch(error => console.error(error));
        }

        // let companiess = [];

        addGeoJsonLayer('assets/js/pacitanJson.json', pacitanLayer, markersData);
        addGeoJsonLayer('assets/js/pringkukuJson.json', pringkukuLayer, markersData);
        addGeoJsonLayer('assets/js/nawanganJson.json', nawanganLayer, markersData);
        addGeoJsonLayer('assets/js/donorojoJson.json', donorojoLayer, markersData);
        addGeoJsonLayer('assets/js/keboagungJson.json', keboagungLayer, markersData);
        addGeoJsonLayer('assets/js/punungJson.json', punungLayer, markersData);
        addGeoJsonLayer('assets/js/arjosariJson.json', arjosariLayer, markersData);
        addGeoJsonLayer('assets/js/sudimoroJson.json', sudimoroLayer, markersData);
        addGeoJsonLayer('assets/js/tulakanJson.json', tulakanLayer, markersData);
        addGeoJsonLayer('assets/js/tegalomboJson.json', tegalomboLayer, markersData);
        addGeoJsonLayer('assets/js/bandarJson.json', bandarLayer, markersData);
        addGeoJsonLayer('assets/js/ngadirejoJson.json', ngadirejoLayer, markersData);

        const overlayMaps = {
            "Kecamatan Pacitan": pacitanLayer,
            "Kecamatan Pringkuku": pringkukuLayer,
            "Kecamatan Nawangan": nawanganLayer,
            "Kecamatan Donorojo": donorojoLayer,
            "Kecamatan Keboagung": keboagungLayer,
            "Kecamatan Punung": punungLayer,
            "Kecamatan Arjosari": arjosariLayer,
            "Kecamatan Sudimoro": sudimoroLayer,
            "Kecamatan Tulakan": tulakanLayer,
            "Kecamatan Tegalombo": tegalomboLayer,
            "Kecamatan Bandar": bandarLayer,
            "Kecamatan Ngadirejo": ngadirejoLayer
        };

        for (let layer in overlayMaps) {
            overlayMaps[layer].addTo(map);
        }
        L.control.layers(null, overlayMaps).addTo(map);


        // noIconMarkers.addTo(map);


        map.addLayer(restaurantMarkers);
        // console.log('restaurantMarkers added to map:', map.hasLayer(restaurantMarkers));


        map.addLayer(bookMarkers);
        // console.log('bookMarker added to map:', map.hasLayer(bookMarkers));

        map.addLayer(hotelMarkers);
        // console.log('hotelMarker added to map:', map.hasLayer(hotelMarkers));
        map.addLayer(gedungMarkers);
        // console.log('bookMarker added to map:', map.hasLayer(gedungMakers));
        map.addLayer(shopingMarkers);
        map.addLayer(pantaiMarkers);

        map.addLayer(noIconMarkers);


        // console.log('bookMarkers added to map:', map.hasLayer(pantaiMakers));


        // console.log('restaurantMarkers:', restaurantMarkers.getLayers().length);
        // console.log('bookMarkers:', bookMarkers.getLayers().length);
        // console.log('icon:', icon);

        const layerControl = L.control.layers({}, {});


        const allMarkers = L.layerGroup([restaurantMarkers, gedungMarkers, hotelMarkers, shopingMarkers,
            pantaiMarkers, bookMarkers, noIconMarkers
        ]).addTo(map);

        const restaurantMarker = L.layerGroup([restaurantMarkers]).addTo(map);


        const bookMarker = L.layerGroup([bookMarkers]).addTo(map);

        const gedungMarker = L.layerGroup([gedungMarkers]).addTo(map);


        const hotelMarker = L.layerGroup([hotelMarkers]).addTo(map);

        const shopingMarker = L.layerGroup([shopingMarkers]).addTo(map);

        const pantaiMarker = L.layerGroup([pantaiMarkers]).addTo(map);


        const noIconMarker = L.layerGroup([noIconMarkers]).addTo(map);





        if (restaurantMarker.getLayers().length > 0) {
            layerControl.addOverlay(restaurantMarker, "Tempat Makan", {
                collapsed: true,
                layerGroup: true,
                icon: restaurantIcon,
            });
        }

        if (bookMarker.getLayers().length > 0) {
            layerControl.addOverlay(bookMarker, "Pendidikan", {
                collapsed: false,
                layerGroup: true,
                icon: BookIcon,
            });
        }

        if (hotelMarker.getLayers().length > 0) {
            layerControl.addOverlay(hotelMarker, "Penginapan", {
                collapsed: false,
                layerGroup: true,
                icon: HotelIcon,
            });
        }

        if (gedungMarker.getLayers().length > 0) {
            layerControl.addOverlay(gedungMarker, "Perusahaan", {
                collapsed: false,
                layerGroup: true,
                icon: GedungIcon,
            });
        }

        if (shopingMarker.getLayers().length > 0) {
            layerControl.addOverlay(shopingMarker, "Belanjaan", {
                collapsed: false,
                layerGroup: true,
                icon: ShopingIcon,
            });
        }

        if (pantaiMarker.getLayers().length > 0) {
            layerControl.addOverlay(pantaiMarker, "Pantai", {
                collapsed: false,
                layerGroup: true,
                icon: PantaiIcon,
            });
        }

        if (allMarkers.getLayers().length > 0) {
            layerControl.addOverlay(allMarkers, "All Markers", {
                collapsed: false,
                layerGroup: true,
            });

        }

        if (noIconMarker.getLayers().length > 0) {
            layerControl.addOverlay(noIconMarker, "No Icon Markers", {
                collapsed: false,
                layerGroup: true
            });
        }

        if (layerControl._layers.length > 0) {
            layerControl.addTo(map);


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
