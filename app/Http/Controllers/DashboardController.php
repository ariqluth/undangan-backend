<?php

namespace App\Http\Controllers;

use App\Models\KbliPerusahaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\DB;
use App\Models\Kbli;
use App\Models\UraianSkalaUsaha;

use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::all();
        $kelurahans = Kelurahan::all();


        $sortedKelurahans = DB::table('kbli_perusahaan')
            ->select('kelurahan.nama_kelurahan', DB::raw('COUNT(*) as jumlah_kbliperusahaan'))
            ->join('kelurahan', 'kbli_perusahaan.kelurahan_id', '=', 'kelurahan.id')
            ->groupBy('kelurahan.nama_kelurahan')
            ->orderByDesc('jumlah_kbliperusahaan')
            ->take(10)
            ->get();

        $chartData = DB::table('kbli_perusahaan')
            ->select('kecamatan.nama_kecamatan', DB::raw('COUNT(*) as jumlah_kbliperusahaan'))
            ->join('kecamatan', 'kbli_perusahaan.kecamatan_id', '=', 'kecamatan.id')
            ->groupBy('kecamatan.nama_kecamatan')
            ->get();

        $jumlahTKIkecamatan = DB::table('kbli_perusahaan')
            ->select('kecamatan.nama_kecamatan', DB::raw('COUNT(tenaga_kerja) as jumlah_tki_kecamatan'))
            ->join('kecamatan', 'kbli_perusahaan.kecamatan_id', '=', 'kecamatan.id')
            ->groupBy('kecamatan.nama_kecamatan')
            ->get();

        $jumlahTKIkelurahan = DB::table('kbli_perusahaan')
            ->select('kelurahan.nama_kelurahan', DB::raw('COUNT(tenaga_kerja) as jumlah_tki_kelurahan'))
            ->join('kelurahan', 'kbli_perusahaan.kelurahan_id', '=', 'kelurahan.id')
            ->groupBy('kelurahan.nama_kelurahan')
            ->orderByDesc('jumlah_tki_kelurahan')
            ->take(10)
            ->get();

        $jumlahTKIUMKM = DB::table('kbli_perusahaan')
            ->select(DB::raw('SUM(tenaga_kerja) as jumlah_tki_umkm'))
            ->get();



        $investasiUMKM = DB::table('kbli_perusahaan')
            ->select(DB::raw('SUM(jumlah_investasi) as jumlah_investasi_umkm'))
            ->get();

        $investasiKecamatans = DB::table('kbli_perusahaan')
            ->select('kecamatan.nama_kecamatan', DB::raw('SUM(jumlah_investasi) as jumlah_investasi_kecamatan'))
            ->join('kecamatan', 'kbli_perusahaan.kecamatan_id', '=', 'kecamatan.id')
            ->groupBy('kecamatan.nama_kecamatan')
            ->orderByDesc('jumlah_investasi_kecamatan')
            ->get();


        $investasiKelurahans = DB::table('kbli_perusahaan')
            ->select('kelurahan.nama_kelurahan', DB::raw('SUM(jumlah_investasi) as jumlah_investasi_kelurahan'))
            ->join('kelurahan', 'kbli_perusahaan.kelurahan_id', '=', 'kelurahan.id')
            ->groupBy('kelurahan.nama_kelurahan')
            ->orderByDesc('jumlah_investasi_kelurahan')
            ->take(10)
            ->get();

        $jumlahTKIkelurahanCount = $jumlahTKIUMKM->sum('jumlah_tki_umkm');
        $investasiUMKMCount = $investasiUMKM->sum('jumlah_investasi_umkm');
        $investasiKecamatanCount = $investasiKecamatans->sum('jumlah_investasi_kecamatan');
        $investasiKelurahanCount = $investasiKelurahans->sum('jumlah_investasi_kelurahan');

        $kbliperusahaans = KbliPerusahaan::paginate(10);
        $kbliperusahaansCount = $kbliperusahaans->total();
        return view('home')->with([
            'kecamatans' => $kecamatans,
            'kelurahans' => $kelurahans,
            'kbliperusahaanCount' => $kbliperusahaansCount,
            'kbliperusahaans' => $kbliperusahaans,
            'sortedKelurahans' => $sortedKelurahans,
            'investasiUMKM' => $investasiUMKM,
            'investasiKecamatans' => $investasiKecamatans,
            'investasiKelurahans' => $investasiKelurahans,
            'investasiUMKMCount' => $investasiUMKMCount,
            'investasiKecamatanCount' => $investasiKecamatanCount,
            'investasiKelurahanCount' => $investasiKelurahanCount,
            'chartData' => $chartData,
            'jumlahTKIkecamatan' => $jumlahTKIkecamatan,
            'jumlahTKIkelurahan' => $jumlahTKIkelurahan,
            'jumlahTKIUMKM' => $jumlahTKIUMKM,
            'jumlahTKIkelurahanCount' => $jumlahTKIkelurahanCount,
        ]);
    }
}
