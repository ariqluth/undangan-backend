<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use App\Models\Visitor;
use App\Models\Kbli;
use App\Models\KbliPerusahaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission.or.visitor:view_dashboard')->only('index');
    }

    public function utama()
    {
        return view('visitor.utama');
    }
    public function index(Request $request)
    {
        $nama_perusahaan = $request->input('nama_perusahaan');
        $nama_pengusaha = $request->input('nama_pengusaha');
        $alamat = $request->input('alamat');
        $kblis = Kbli::all();
        $kecamatans = Kecamatan::all();
        $kelurahans = Kelurahan::all();
        $gambar = Gambar::all();


        $kbliperusahaans = DB::table('kbli_perusahaan')
            ->select(
                'kbli_perusahaan.id as kbliperusahaan_Id',
                'kbli_perusahaan.kode_proyek as kode_proyek',
                'kbli_perusahaan.npwp as npwp',
                'kbli_perusahaan.alamat as alamat',
                'kbli_perusahaan.longtitude',
                'kbli_perusahaan.latitude',
                'kbli_perusahaan.mesin_peralatan',
                'kbli_perusahaan.mesin_peralatan_impor',
                'kbli_perusahaan.pembelian_pematangan_tanah',
                'kbli_perusahaan.bangunan_gedung',
                'kbli_perusahaan.lain_lain',
                'kbli_perusahaan.modal_kerja',
                'kbli_perusahaan.jumlah_investasi',
                'kbli_perusahaan.tenaga_kerja',
                'perusahaan.nama_perusahaan as nama_perusahaan',
                'perusahaan.nib as nib',
                'perusahaan.no_telp as no_telp',
                'kab.nama_kabupaten',
                'kecamatan.nama_kecamatan as nama_kecamatan ',
                'kelurahan.nama_kelurahan as nama_kelurahan ',
                'kbli_perusahaan.kbli_id',
                'kbli.kbli as kbli',
                'kbli.judul_kbli as judul_kbli',
                'kbli.sektor as sektor',
                'ujp.nama_uraian_jenis_perusahaan as nama_uraian_jenis_perusahaan',
                'uraian_resiko_proyek.nama_uraian_resiko_proyek as nama_uraian_resiko_proyek',
                'uraian_skala_usaha.nama_uraian_skala_usaha as nama_uraian_skala_usaha',
                'pm.status_pmdn as status_pmdn',
                'kbli_perusahaan.profile_pengusaha_id as nama_penguasaha ',
                'kecamatan.nama_kecamatan',
                'profile_pengusaha.nama_pengusaha',
                'kelurahan.nama_kelurahan',
               'gambar.path as gambar'
            )
            ->leftJoin('perusahaan', 'kbli_perusahaan.perusahaan_id', '=', 'perusahaan.id')
            ->leftJoin('kbli', 'kbli_perusahaan.kbli_id', '=', 'kbli.id')
            ->leftJoin('profile_pengusaha', 'kbli_perusahaan.profile_pengusaha_id', '=', 'profile_pengusaha.id')
            ->leftJoin('kabupaten as kab', function ($join) {
                $join->on('perusahaan.kabupaten_id', '=', 'kab.id');
            })
            ->leftJoin('uraian_jenis_perusahaan as ujp', function ($join) {
                $join->on('perusahaan.uraian_jenis_perusahaan_id', '=', 'ujp.id');
            })
            ->leftJoin('penanaman_modal as pm', function ($join) {
                $join->on('perusahaan.penanaman_modal_id', '=', 'pm.id');
            })
            ->leftjoin('gambar_kbli_perusahaan', 'kbli_perusahaan.id', '=', 'gambar_kbli_perusahaan.kbli_perusahaan_id')
            ->leftjoin('gambar', 'gambar_kbli_perusahaan.gambar_id', '=', 'gambar.id')

            ->leftJoin('kecamatan', 'kbli_perusahaan.kecamatan_id', '=', 'kecamatan.id')
            ->leftJoin('kelurahan', 'kbli_perusahaan.kelurahan_id', '=', 'kelurahan.id')
            ->leftJoin('uraian_resiko_proyek', 'uraian_resiko_proyek_id', '=', 'uraian_resiko_proyek.id')
            ->leftJoin('uraian_skala_usaha', 'uraian_skala_usaha_id', '=', 'uraian_skala_usaha.id')

            ->when($request->input('nama_perusahaan'), function ($query, $nama_perusahaan) {
                return $query->where('nama_perusahaan', 'like', '%' . $nama_perusahaan . '%');
            })
            ->when($request->input('nama_pengusaha'), function ($query, $nama_pengusaha) {
                return $query->where('nama_pengusaha', 'like', '%' . $nama_pengusaha . '%');
            })
            ->when($request->input('alamat'), function ($query, $alamat) {
                return $query->where('kbli_perusahaan.alamat', 'like', '%' . $alamat . '%');
            })
            ->when($request->input('kecamatan'), function ($query, $kecamatan) {
                return $query->whereIn('kbli_perusahaan.kecamatan_id', $kecamatan);
            })
            ->when($request->input('kelurahan'), function ($query, $kelurahan) {
                return $query->whereIn('kbli_perusahaan.kelurahan_id', $kelurahan);
            })
            ->when($request->input('kbli'), function ($query, $kbli) {
                return $query->whereIn('kbli_perusahaan.kbli_id', $kbli);
             })

            ->paginate(20);
        $kecamatanSelected = $request->input('kecamatan');
        $kelurahanSelected = $request->input('kelurahan');
        $kbliSelected = $request->input('kbli');
        $kbliperusahaansCount = $kbliperusahaans->total();
        return view('visitor.index')->with([
            'nama_perusahaan' => $nama_perusahaan,
            'nama_pengusaha' => $nama_pengusaha,
            'kecamatans' => $kecamatans,
            'kelurahans' => $kelurahans,
            'kbliperusahaans' => $kbliperusahaans,
            'kblis' => $kblis,
            'kbliperusahaanCount' => $kbliperusahaansCount,
            'nama_perusahaan' => $nama_perusahaan,
            'nama_pengusaha' => $nama_pengusaha,
            'alamat' => $alamat,
            'kecamatanSelected' => $kecamatanSelected,
            'kelurahanSelected' => $kelurahanSelected,
            'kbliSelected' => $kbliSelected,
            'gambar' => $gambar,
        ]);
    }

    public function mapvisitor(Request $request)
    {
        $nama_perusahaan = $request->input('nama_perusahaan');
        $nama_pengusaha = $request->input('nama_pengusaha');
        $alamat = $request->input('alamat');
        $kblis = Kbli::all();
        $kecamatans = Kecamatan::all();
        $gambar = Gambar::all();
        $kelurahans = Kelurahan::all();

        $kbliperusahaans = DB::table('kbli_perusahaan')
            ->select(
                'kbli_perusahaan.id as kbliperusahaan_Id',
                'kbli_perusahaan.kode_proyek as kode_proyek',
                'kbli_perusahaan.npwp as npwp',
                'kbli_perusahaan.alamat as alamat',
                'kbli_perusahaan.longtitude',
                'kbli_perusahaan.latitude',
                'kbli_perusahaan.mesin_peralatan',
                'kbli_perusahaan.mesin_peralatan_impor',
                'kbli_perusahaan.pembelian_pematangan_tanah',
                'kbli_perusahaan.bangunan_gedung',
                'kbli_perusahaan.lain_lain',
                'kbli_perusahaan.modal_kerja',
                'kbli_perusahaan.jumlah_investasi',
                'kbli_perusahaan.tenaga_kerja',
                'perusahaan.nama_perusahaan as nama_perusahaan',
                'perusahaan.nib as nib',
                'kab.nama_kabupaten',
                'kecamatan.nama_kecamatan as nama_kecamatan ',
                'kelurahan.nama_kelurahan as nama_kelurahan ',
                'kbli_perusahaan.kbli_id',
                'kbli.kbli as kbli',
                'kbli.judul_kbli as judul_kbli',
                'kbli.sektor as sektor',
                'ujp.nama_uraian_jenis_perusahaan as nama_uraian_jenis_perusahaan',
                'uraian_resiko_proyek.nama_uraian_resiko_proyek as nama_uraian_resiko_proyek',
                'uraian_skala_usaha.nama_uraian_skala_usaha as nama_uraian_skala_usaha',
                'pm.status_pmdn as status_pmdn',
                'kbli_perusahaan.profile_pengusaha_id as nama_penguasaha ',
                'kecamatan.nama_kecamatan',
                'profile_pengusaha.nama_pengusaha',
                'kelurahan.nama_kelurahan',
                'gambar.path as gambar',
            )
            ->leftJoin('perusahaan', 'kbli_perusahaan.perusahaan_id', '=', 'perusahaan.id')
            ->leftJoin('kbli', 'kbli_perusahaan.kbli_id', '=', 'kbli.id')
            ->leftJoin('profile_pengusaha', 'kbli_perusahaan.profile_pengusaha_id', '=', 'profile_pengusaha.id')
            ->leftjoin('gambar_kbli_perusahaan', 'kbli_perusahaan.id', '=', 'gambar_kbli_perusahaan.kbli_perusahaan_id')
            ->leftjoin('gambar', 'gambar_kbli_perusahaan.gambar_id', '=', 'gambar.id')

            ->leftJoin('kabupaten as kab', function ($join) {
                $join->on('perusahaan.kabupaten_id', '=', 'kab.id');
            })
            ->leftJoin('uraian_jenis_perusahaan as ujp', function ($join) {
                $join->on('perusahaan.uraian_jenis_perusahaan_id', '=', 'ujp.id');
            })
            ->leftJoin('penanaman_modal as pm', function ($join) {
                $join->on('perusahaan.penanaman_modal_id', '=', 'pm.id');
            })
            ->leftJoin('kecamatan', 'kbli_perusahaan.kecamatan_id', '=', 'kecamatan.id')
            ->leftJoin('kelurahan', 'kbli_perusahaan.kelurahan_id', '=', 'kelurahan.id')
            ->leftJoin('uraian_resiko_proyek', 'uraian_resiko_proyek_id', '=', 'uraian_resiko_proyek.id')
            ->leftJoin('uraian_skala_usaha', 'uraian_skala_usaha_id', '=', 'uraian_skala_usaha.id')

            ->when($request->input('nama_perusahaan'), function ($query, $nama_perusahaan) {
                return $query->where('nama_perusahaan', 'like', '%' . $nama_perusahaan . '%');
            })
            ->when($request->input('nama_pengusaha'), function ($query, $nama_pengusaha) {
                return $query->where('nama_pengusaha', 'like', '%' . $nama_pengusaha . '%');
            })
            ->when($request->input('alamat'), function ($query, $alamat) {
                return $query->where('kbli_perusahaan.alamat', 'like', '%' . $alamat . '%');
            })
            ->when($request->input('kecamatan'), function ($query, $kecamatan) {
                return $query->whereIn('kbli_perusahaan.kecamatan_id', $kecamatan);
            })
            ->when($request->input('kelurahan'), function ($query, $kelurahan) {
                return $query->whereIn('kbli_perusahaan.kelurahan_id', $kelurahan);
            })
            ->when($request->input('kbli'), function ($query, $kbli) {
                return $query->whereIn('kbli_perusahaan.kbli_id', $kbli);
            })

            ->paginate(20);
        $kecamatanSelected = $request->input('kecamatan');
        $kelurahanSelected = $request->input('kelurahan');
        $kbliSelected = $request->input('kbli');
        $kbliperusahaansCount = $kbliperusahaans->total();
        return view('visitor.mapVisitor')->with([
            'nama_perusahaan' => $nama_perusahaan,
            'nama_pengusaha' => $nama_pengusaha,
            'kecamatans' => $kecamatans,
            'kelurahans' => $kelurahans,
            'kbliperusahaans' => $kbliperusahaans,
            'kblis' => $kblis,
            'kbliperusahaanCount' => $kbliperusahaansCount,
            'nama_perusahaan' => $nama_perusahaan,
            'nama_pengusaha' => $nama_pengusaha,
            'alamat' => $alamat,
            'kecamatanSelected' => $kecamatanSelected,
            'kelurahanSelected' => $kelurahanSelected,
            'kbliSelected' => $kbliSelected,
            'gambar' => $gambar,
        ]);
    }


    public function getDataFromDatabase()
    {
        $kbliperusahaans = Kbliperusahaan::all();
        $data = [];
        foreach ($kbliperusahaans as $kbliperusahaan) {
            $data[] = [
                'lat' => isset($kbliperusahaan->latitude) ? $kbliperusahaan->latitude : '0',
                'lng' => isset($kbliperusahaan->longtitude) ? $kbliperusahaan->longtitude : '0',
                'kbli' => isset($kbliperusahaan->kbli) ? $kbliperusahaan->kbli : '',
                'perusahaan' => isset($kbliperusahaan->nama_perusahaan) ? $kbliperusahaan->nama_perusahaan : '',
                'pengusaha' => isset($kbliperusahaan->nama_pengusaha) ? $kbliperusahaan->nama_pengusaha : '',
                'gambar' => isset($kbliperusahaan->gambar) ? $kbliperusahaan->gambar : '',
                'uraian_jenis_perusahaan' => isset($kbliperusahaan->nama_uraian_jenis_perusahaan) ? $kbliperusahaan->nama_uraian_jenis_perusahaan : '',
                'uraian_skala_usaha' => isset($kbliperusahaan->nama_uraian_skala_usaha) ? $kbliperusahaan->nama_uraian_skala_usaha : '',
                'uraian_resiko_proyek' => isset($kbliperusahaan->nama_uraian_resiko_proyek) ? $kbliperusahaan->nama_uraian_resiko_proyek : ''
            ];
        }
        $json = json_encode($data);
        return response()->json($json);
    }


    public function fetchCompanyData($id)
    {
        $company = KbliPerusahaan::find($id);

        return response()->json($company);
    }

    public function getMarker(Request $request) {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}
