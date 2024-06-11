<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignApproveRequest;
use App\Http\Requests\UpdateAssignApproveRequest;
use App\Models\AssignApprove;
use App\Models\Gambar;
use App\Models\Kbli;
use App\Models\KbliPerusahaan;
use App\Models\KbliPerusahaanGambarJoin;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignApproveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:assign-approve.index')->only('index');
        $this->middleware('permission:assign-approve.create')->only('create', 'store');
        $this->middleware('permission:assign-approve.edit')->only('edit', 'update');
        $this->middleware('permission:assign-approve.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $nama_perusahaan = $request->input('nama_perusahaan');
        $kbli_perusahaan = KbliPerusahaan::all();
        $user = User::all();
        $kblis = Kbli::all();
        $gambar_kbli_perusahaan = Gambar::all();
        $assignApprove = AssignApprove::with('kbli_perusahaan.gambar')
            ->select(
                'assign_approve.id',
                'assign_approve.id as assign_approve_id',
                'assign_approve.kbli_perusahaan_id',
                'kbli_perusahaan.id as kbli_perusahaan_id_fk',
                'kbli_perusahaan.perusahaan_id',
                'perusahaan.nama_perusahaan',
                'perusahaan.nib',
                'perusahaan.penanaman_modal_id',
                'pm.status_pmdn as status_pmdn',
                'perusahaan.uraian_jenis_perusahaan_id',
                'ujp.nama_uraian_jenis_perusahaan',
                'perusahaan.alamat as alamat_perusahaan',
                'perusahaan.kabupaten_id',
                'kab.nama_kabupaten',
                'perusahaan.email as email_perusahaan',
                'perusahaan.no_telp as no_telp_perusahaan',
                'kbli_perusahaan.npwp',
                'kbli_perusahaan.kode_proyek',
                'kbli_perusahaan.kbli_id',
                'kbli.kbli as kbli',
                'kbli.judul_kbli as judul_kbli',
                'kbli.sektor as sektor',
                'kbli_perusahaan.uraian_resiko_proyek_id',
                'uraian_resiko_proyek.nama_uraian_resiko_proyek as nama_uraian_resiko_proyek',
                'kbli_perusahaan.uraian_skala_usaha_id',
                'uraian_skala_usaha.nama_uraian_skala_usaha as nama_uraian_skala_usaha',
                'kbli_perusahaan.alamat',
                'kbli_perusahaan.kecamatan_id',
                'kecamatan.nama_kecamatan',
                'kbli_perusahaan.kelurahan_id',
                'kelurahan.nama_kelurahan',
                'kbli_perusahaan.longtitude',
                'kbli_perusahaan.latitude',
                'kbli_perusahaan.profile_pengusaha_id',
                'profile_pengusaha.nama_pengusaha as nama_pengusaha',
                'profile_pengusaha.no_telp as no_telp_pengusaha',
                'profile_pengusaha.email as email_pengusaha',
                'kbli_perusahaan.mesin_peralatan',
                'kbli_perusahaan.mesin_peralatan_impor',
                'kbli_perusahaan.pembelian_pematangan_tanah',
                'kbli_perusahaan.bangunan_gedung',
                'kbli_perusahaan.modal_kerja',
                'kbli_perusahaan.lain_lain',
                'kbli_perusahaan.jumlah_investasi',
                'kbli_perusahaan.tenaga_kerja',
                'gambar.path as gambar',
                'assign_approve.assign_to',
                'assigned_users.name as assign_to_name',
                'assign_approve.status',
                'assign_approve.perubahan',
                'assign_approve.approve_by',
                'approved_users.name as approved_by_name',
                'assign_approve.approve_at',
                DB::raw("CAST(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.assignApproveID') AS UNSIGNED) as assign_approve_id_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.perusahaan_id'), '\"', '') as perusahaan_id_json"),
                'perusahaan_json.nama_perusahaan as nama_perusahaan_json',
                'perusahaan_json.nib as nib_json',
                'perusahaan_json.penanaman_modal_id as penanaman_modal_id_json',
                'pm_json.status_pmdn as status_pmdn_json',
                'perusahaan_json.uraian_jenis_perusahaan_id as uraian_jenis_perusahaan_id_json',
                'ujp_json.nama_uraian_jenis_perusahaan as nama_uraian_jenis_perusahaan_json',
                'perusahaan_json.alamat as alamat_perusahaan_json',
                'perusahaan_json.kabupaten_id as kabupaten_id_json',
                'kab_json.nama_kabupaten as nama_kabupaten_json',
                'perusahaan_json.email as email_json',
                'perusahaan_json.no_telp as no_telp_json',
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.npwp'), '\"', '') as npwp_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.kode_proyek'), '\"', '') as kode_proyek_json"),
                'kbli_json.kbli as kbli_json',
                'kbli_json.judul_kbli as judul_kbli_json',
                'kbli_json.sektor as sektor_json',
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.uraian_resiko_proyek_id'), '\"', '') as uraian_resiko_proyek_id_json"),
                'uraian_resiko_proyek_json.nama_uraian_resiko_proyek as nama_uraian_resiko_proyek_json',
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.uraian_skala_usaha_id'), '\"', '') as uraian_skala_usaha_id_json"),
                'uraian_skala_usaha_json.nama_uraian_skala_usaha as nama_uraian_skala_usaha_json',
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.alamat'), '\"', '') as alamat_kbliperusahaan_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.kecamatan_id'), '\"', '') as kecamatan_id_json"),
                'kecamatan_json.nama_kecamatan as nama_kecamatan_json',
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.kelurahan_id'), '\"', '') as kelurahan_id_json"),
                'kelurahan_json.nama_kelurahan as nama_kelurahan_json',
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.longtitude'), '\"', '') as longtitude_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.latitude'), '\"', '') as latitude_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.profile_pengusaha_id'), '\"', '') as profile_pengusaha_id_json"),
                'profile_pengusaha_json.nomor_identitas_user as nomor_identitas_user_json',
                'profile_pengusaha_json.nama_pengusaha as nama_pengusaha_json',
                'profile_pengusaha_json.no_telp as no_telp_pengusaha_json',
                'profile_pengusaha_json.email as email_pengusaha_json',
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.mesin_peralatan'), '\"', '') as mesin_peralatan_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.mesin_peralatan_impor'), '\"', '') as mesin_peralatan_impor_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.pembelian_pematangan_tanah'), '\"', '') as pembelian_pematangan_tanah_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.bangunan_gedung'), '\"', '') as bangunan_gedung_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.modal_kerja'), '\"', '') as modal_kerja_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.lain_lain'), '\"', '') as lain_lain_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.jumlah_investasi'), '\"', '') as jumlah_investasi_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.tenaga_kerja'), '\"', '') as tenaga_kerja_json"),
                DB::raw("REPLACE(assign_approve.gambar_kbli_perusahaan_json, '\"', '') as gambar_json")
            )
            ->leftJoin('users as assigned_users', 'assign_approve.assign_to', '=', 'assigned_users.id')
            ->leftJoin('users as approved_users', 'assign_approve.approve_by', '=', 'approved_users.id')
            ->leftJoin('kbli_perusahaan', 'assign_approve.kbli_perusahaan_id', '=', 'kbli_perusahaan.id')
            ->leftJoin('perusahaan', 'kbli_perusahaan.perusahaan_id', '=', 'perusahaan.id')
            ->leftJoin('penanaman_modal as pm', function ($join) {
                $join->on('perusahaan.penanaman_modal_id', '=', 'pm.id');
            })
            ->leftJoin('uraian_jenis_perusahaan as ujp', function ($join) {
                $join->on('perusahaan.uraian_jenis_perusahaan_id', '=', 'ujp.id');
            })
            ->leftJoin('kabupaten as kab', function ($join) {
                $join->on('perusahaan.kabupaten_id', '=', 'kab.id');
            })
            ->leftJoin('kbli', 'kbli_perusahaan.kbli_id', '=', 'kbli.id')
            ->leftJoin('uraian_resiko_proyek', 'uraian_resiko_proyek_id', '=', 'uraian_resiko_proyek.id')
            ->leftJoin('uraian_skala_usaha', 'uraian_skala_usaha_id', '=', 'uraian_skala_usaha.id')
            ->leftJoin('kecamatan', 'kbli_perusahaan.kecamatan_id', '=', 'kecamatan.id')
            ->leftJoin('kelurahan', 'kbli_perusahaan.kelurahan_id', '=', 'kelurahan.id')
            ->leftJoin('profile_pengusaha', 'kbli_perusahaan.profile_pengusaha_id', '=', 'profile_pengusaha.id')
            ->leftJoin('perusahaan as perusahaan_json', function ($join) {
                $join->on(
                    'perusahaan_json.id',
                    '=',
                    DB::raw("JSON_UNQUOTE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.perusahaan_id'))")
                );
            })
            ->leftJoin('gambar_kbli_perusahaan', 'kbli_perusahaan.id', '=', 'gambar_kbli_perusahaan.kbli_perusahaan_id')
            ->leftJoin('gambar', 'gambar_kbli_perusahaan.gambar_id', '=', 'gambar.id')
            ->leftJoin('penanaman_modal as pm_json', function ($join) {
                $join->on('perusahaan_json.penanaman_modal_id', '=', 'pm_json.id');
            })
            ->leftJoin('uraian_jenis_perusahaan as ujp_json', function ($join) {
                $join->on('perusahaan_json.uraian_jenis_perusahaan_id', '=', 'ujp_json.id');
            })
            ->leftJoin('kabupaten as kab_json', function ($join) {
                $join->on('perusahaan_json.kabupaten_id', '=', 'kab_json.id');
            })
            ->leftJoin('kbli as kbli_json', function ($join) {
                $join->on(
                    'kbli_json.id',
                    '=',
                    DB::raw("JSON_UNQUOTE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.kbli_id'))")
                );
            })
            ->leftJoin('uraian_resiko_proyek as uraian_resiko_proyek_json', function ($join) {
                $join->on(
                    'uraian_resiko_proyek_json.id',
                    '=',
                    DB::raw("JSON_UNQUOTE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.uraian_resiko_proyek_id'))")
                );
            })
            ->leftJoin('uraian_skala_usaha as uraian_skala_usaha_json', function ($join) {
                $join->on(
                    'uraian_skala_usaha_json.id',
                    '=',
                    DB::raw("JSON_UNQUOTE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.uraian_skala_usaha_id'))")
                );
            })
            ->leftJoin('kecamatan as kecamatan_json', function ($join) {
                $join->on(
                    'kecamatan_json.id',
                    '=',
                    DB::raw("JSON_UNQUOTE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.kecamatan_id'))")
                );
            })
            ->leftJoin('kelurahan as kelurahan_json', function ($join) {
                $join->on(
                    'kelurahan_json.id',
                    '=',
                    DB::raw("JSON_UNQUOTE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.kelurahan_id'))")
                );
            })
            ->leftJoin('profile_pengusaha as profile_pengusaha_json', function ($join) {
                $join->on(
                    'profile_pengusaha_json.id',
                    '=',
                    DB::raw("JSON_UNQUOTE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.profile_pengusaha_id'))")
                );
            })
            ->where('assign_approve.data_terhapus', '=', 'false')
            ->when($request->input('nama_perusahaan'), function ($query, $nama_perusahaan) {
                return $query->where('nama_perusahaan', 'like', '%' . $nama_perusahaan . '%');
            })
            ->when($request->input('kbli'), function ($query, $kbli) {
                return $query->whereIn('kbli_perusahaan.kbli_id', $kbli);
            })
            ->when($request->input('users'), function ($query, $users) {
                return $query->whereIn('assign_approve.assign_to', $users);
            })
            ->paginate(5);
        $kbliSelected = $request->input('kbli');
        $usersSelected = $request->input('users');

        // dd($assignApprove);
        return view('penugasan.assign-approve.index')
            ->with([
                'kbli_perusahaan' => $kbli_perusahaan,
                'users' => $user,
                'assignApprove' => $assignApprove,
                'gambar_kbli_perusahaan' => $gambar_kbli_perusahaan,
                'kbliSelected' => $kbliSelected,
                'nama_perusahaan' => $nama_perusahaan,
                'kblis' => $kblis,
                'usersSelected' => $usersSelected,
            ]);
    }

    public function approve(AssignApprove $assignApprove, $id)
    {
        $assignApprove = AssignApprove::findOrFail($id);

        if (empty($assignApprove->kbli_perusahaan_json)) {
            return redirect()->back()->with('error', 'Item cannot be approved because kbli_perusahaan_json is empty.');
        }

        $assignApprove->status = 'Approved';
        $assignApprove->approve_by = Auth::user()->id;
        $assignApprove->approve_at = now();
        $assignApprove->save();

        $this->updateJSON($assignApprove, $assignApprove->id);
        return redirect()->back()->with('success', 'Item has been approved.');
    }

    public function unapprove($id)
    {
        $assignApprove = AssignApprove::findOrFail($id);
        $assignApprove->status = 'Rejected';
        $assignApprove->approve_by = null;
        $assignApprove->approve_at = null;
        $assignApprove->save();

        return redirect()->back()->with('success', 'Verification has been removed.');
    }

    public function reject($id)
    {
        $assignApprove = AssignApprove::findOrFail($id);
        if (empty($assignApprove->kbli_perusahaan_json)) {
            return redirect()->back()->with('error', 'Item cannot be reject because kbli_perusahaan_json is empty.');
        }
        $assignApprove->status = 'Rejected';
        $assignApprove->save();

        return redirect()->back()->with('success', 'Item has been rejected.');
    }

    public function updateJSON(AssignApprove $assignApprove, $id)
    {
        $assignApprove = AssignApprove::findOrFail($id);
        $kbli_perusahaan_json = $assignApprove->kbli_perusahaan_json;
        $gambar_kbli_perusahaan_json = $assignApprove->gambar_kbli_perusahaan_json;
        $cocokQuery = $assignApprove->kbli_perusahaan_id;

        if ($kbli_perusahaan_json) {
            $kbli_perusahaan_data = json_decode($kbli_perusahaan_json, true);
            $kbli_perusahaan = KbliPerusahaan::where('id', $cocokQuery)->first();
            if (!$kbli_perusahaan) {
                $kbli_perusahaan = new KbliPerusahaan;
                $kbli_perusahaan->perusahaan_id = $kbli_perusahaan_data['assignApproveID'];
            }
            $kbli_perusahaan->longtitude = $kbli_perusahaan_data['longtitude'];
            $kbli_perusahaan->latitude = $kbli_perusahaan_data['latitude'];
            $kbli_perusahaan->save();
            $assignApprove->kbli_perusahaan_id = $kbli_perusahaan->id;
        }

        if ($gambar_kbli_perusahaan_json) {
            $gambar_kbli_perusahaan_json = str_replace('"', '', $gambar_kbli_perusahaan_json);
            $oldPath = 'public/assets/img/api/' . $gambar_kbli_perusahaan_json;
            $newName = uniqid() . '_' . $gambar_kbli_perusahaan_json;
            $newPath = 'public/assets/img/database/' . $newName;

            if (Storage::exists($oldPath)) {
                Storage::copy($oldPath, $newPath);
                $gambarJoin = KbliPerusahaanGambarJoin::where('kbli_perusahaan_id', $assignApprove->kbli_perusahaan_id)->first();
                $gambarKbliPerusahaan = new Gambar;
                $gambarKbliPerusahaan->path = 'assets/img/database/' . $newName;
                $gambarKbliPerusahaan->nama_gambar = $newName;
                $gambarKbliPerusahaan->star = 1;
                $gambarKbliPerusahaan->save();

                if (!$gambarJoin) {
                    $gambarJoin = new KbliPerusahaanGambarJoin;
                    $gambarJoin->kbli_perusahaan_id = $assignApprove->kbli_perusahaan_id;
                    $gambarJoin->gambar_id = $gambarKbliPerusahaan->id;
                    $gambarJoin->save();
                } else {
                    $gambarJoin->gambar_id = $gambarKbliPerusahaan->id;
                    $gambarJoin->save();
                }
            }
        }
        $assignApprove->save();

        return redirect()->back()->with('success', 'Item has been updated.');
    }


    public function create()
    {
        $user = User::all();
        return view(
            'penugasan.assign-approve.create'
        )->with([
            'user' => $user,
        ]);
    }

    public function kbliperusahaanfilter(Request $request)
    {
        $kbliPerusahaan['KbliPerusahaan'] = KbliPerusahaan::where('perusahaan_id', $request->id)
            ->leftJoin('kbli', 'kbli_perusahaan.kbli_id', '=', 'kbli.id')
             ->select(
                'kbli_perusahaan.id as kbli_perusahaan_id',
                'kbli.id as kbli_id',
                'kbli.kbli',
                'kbli.judul_kbli',
                'kbli.sektor'
            )
            ->get();
        return response()->json($kbliPerusahaan);
    }


    public function store(StoreAssignApproveRequest $request)
    {
        $user = Auth::user();
        AssignApprove::create([
            'kbli_perusahaan_id' => $request->kbli_perusahaan_id,
            'assign_to' => $request->assign_to,
            'status' => "pending",
            'perubahan' => 'proses',
            'approve_by' => null,
            'approve_at' => null,
            'updated_by' => $user->id,
            'created_by' => $user->id,
        ]);
        return redirect()->route('assign-approve.index')->with('success', 'Tambah Data Penugasan Sukses');
    }

    public function edit(AssignApprove $assignApprove)
    {
        $user = User::all();
        $perusahaan = Perusahaan::all();
        $kbliPerusahaan = KbliPerusahaan::all();
        $kbli = Kbli::all();
        $perusahaanSelected = $assignApprove->kbli_perusahaan->perusahaan_id;
        return view(
            'penugasan.assign-approve.edit'
        )->with([
            'user' => $user,
            'kbli' => $kbli,
            'perusahaan' => $perusahaan,
            'kbliPerusahaan' => $kbliPerusahaan,
            'assignApprove' => $assignApprove,
            'perusahaanSelected' => $perusahaanSelected,
        ]);
    }

    public function kbliperusahaanfiltered(Request $request)
    {
        $kbliPerusahaan['KbliPerusahaan'] = KbliPerusahaan::where('perusahaan_id', $request->id)
            ->leftJoin('kbli', 'kbli_perusahaan.kbli_id', '=', 'kbli.id')
            ->select(
                'kbli_perusahaan.id as kbli_perusahaan_id',
                'kbli_perusahaan.perusahaan_id',
                'kbli.id as kbli_id',
                'kbli.kbli',
                'kbli.judul_kbli',
                'kbli.sektor'
            )
            ->get();
        return response()->json($kbliPerusahaan);
    }

    public function update(UpdateAssignApproveRequest $request, AssignApprove $assignApprove)
    {
        $validate = $request->validated();
        $validate['updated_at'] = now();
        $validate['updated_by'] = auth()->user()->id;

        $assignApprove->fill($validate);
        $assignApprove->save();

        return redirect()->route('assign-approve.index')->with('success', 'Edit Data Penugasan Sukses');
    }



    public function destroy(AssignApprove $assignApprove)
    {
        if ($assignApprove->status === 'approved') {
            return redirect()->route('assign-approve.index')
                ->with('error', 'Tidak Dapat Menghapus Penugasan Yang Telah Disetujui');
        }
        try {
            // dd(Auth::user()->name);
            $assignApprove->data_terhapus = true;
            $assignApprove->delete_by = Auth::user()->id;
            $assignApprove->delete_at = now();
            $assignApprove->save();
            return redirect()->route('assign-approve.index')->with('success', 'Hapus Data Penugasan Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('assign-approve.index')
                    ->with('error', 'Tidak Dapat Menghapus Penugasan Yang Masih Digunakan Oleh Kolom Lain');
            } else {
                return redirect()->route('assign-approve.index')->with('success', 'Hapus Data Penugasan Sukses');
            }
        }
    }
}
