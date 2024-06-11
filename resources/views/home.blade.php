@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total UMKM</h4>
                        </div>
                        <div class="card-body">
                            <h4>{{ number_format($kbliperusahaanCount, 0, '.', '.') }}</h4>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Investasi UMKM</h4>
                        </div>
                        <div class="card-body">
                            <h4> @currency($investasiUMKMCount)</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Tenaga Kerja Terserap UMKM</h4>
                        </div>
                        <div class="card-body">
                            <h4>{{ number_format($jumlahTKIkelurahanCount, 0, '.', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Jumlah UMKM Per-Kecamatan</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChartCanvas1"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>10 Teratas Kelurahan dengan Jumlah UMKM Tertinggi</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChartCanvas"></canvas>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Jumlah UMKM Tiap Kecamatan</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kecamatan</th>
                                    <th>Jumlah UMKM</th>
                                </tr>
                                @foreach ($chartData as $jumlahUMKMkecamatan)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td>{{ $jumlahUMKMkecamatan->nama_kecamatan }}</td>
                                        <td>{{ $jumlahUMKMkecamatan->jumlah_kbliperusahaan }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Jumlah Investasi Tiap Kecamatan</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kecamatan</th>
                                    <th>Jumlah Investasi</th>
                                </tr>
                                @foreach ($investasiKecamatans as $kecamatan)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td>{{ $kecamatan->nama_kecamatan }}</td>
                                        <td>@currency($kecamatan->jumlah_investasi_kecamatan)</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Jumlah Tenaga Kerja Tiap Kecamatan</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kecamatan</th>
                                    <th>Jumlah Tenaga Kerja</th>
                                </tr>
                                @foreach ($jumlahTKIkecamatan as $tenagaKerjaKecamatan)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td>{{ $tenagaKerjaKecamatan->nama_kecamatan }}</td>
                                        <td>{{ $tenagaKerjaKecamatan->jumlah_tki_kecamatan }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>10 Teratas Kelurahan dengan Jumlah UMKM Tertinggi</h4>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelurahan</th>
                                    <th>Jumlah UMKM</th>
                                </tr>
                                @foreach ($sortedKelurahans as $kelurahan)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td>{{ $kelurahan->nama_kelurahan }}</td>
                                        <td>{{ $kelurahan->jumlah_kbliperusahaan }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>10 Teratas Kelurahan dengan Jumlah Investasi Tertinggi</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelurahan</th>
                                    <th>Jumlah Investasi</th>
                                </tr>
                                @foreach ($investasiKelurahans as $kelurahan)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td>{{ $kelurahan->nama_kelurahan }}</td>
                                        <td>@currency($kelurahan->jumlah_investasi_kelurahan)</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>10 Teratas Kelurahan dengan Jumlah Tenaga Kerja Tertinggi</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelurahan</th>
                                    <th>Jumlah Tenaga Kerja</th>
                                </tr>
                                @foreach ($jumlahTKIkelurahan as $tenagaKerjakelurahan)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td>{{ $tenagaKerjakelurahan->nama_kelurahan }}</td>
                                        <td>{{ $tenagaKerjakelurahan->jumlah_tki_kelurahan }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
@push('customScript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var chartData = @json($chartData);
        var themeColors = ['#575fcf', '#34bfa3', '#f4516c', '#ffb822', '#36a3f7', '#fb9678', '#a092f1', '#f3c200',
            '#f96868', '#8d6e63', '#63ED7A', '#191D21', '#E3EAEF', '#6777EF'
        ];
        var labels = chartData.map(function(item) {
            return item.nama_kecamatan;
        });
        var data = chartData.map(function(item) {
            return item.jumlah_kbliperusahaan;
        });

        var donutChartCanvas1 = document.getElementById("donutChartCanvas1").getContext("2d");

        new Chart(donutChartCanvas1, {
            type: "doughnut",
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: themeColors,
                    borderWidth: 4,
                }],
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
            }
        });
    </script>

    <script>
        var themeColors = ['#575fcf', '#34bfa3', '#f4516c', '#ffb822', '#36a3f7', '#fb9678', '#a092f1', '#f3c200',
            '#f96868', '#8d6e63', '#63ED7A', '#191D21', '#E3EAEF', '#6777EF'
        ];

        var top10KelurahanData = JSON.parse('@json($sortedKelurahans)');
        var labels = [];
        var data = [];

        top10KelurahanData.forEach(function(item) {
            labels.push(item.nama_kelurahan);
            data.push(item.jumlah_kbliperusahaan);
        });

        var kelurahanColors = themeColors.slice(0, top10KelurahanData.length);

        var donutChartCanvas = document.getElementById("donutChartCanvas").getContext("2d");

        new Chart(donutChartCanvas, {
            type: "doughnut",
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: kelurahanColors,
                    borderWidth: 4
                }],
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
            }
        });
    </script>
@endpush
