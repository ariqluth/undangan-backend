<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignApproveRequest;
use App\Http\Requests\UpdateAssignApproveRequest;
use App\Models\AssignApprove;
use App\Models\Gambar;
use App\Models\Kbli;
use App\Models\KbliPerusahaan;
use App\Models\KbliPerusahaanGambarJoin;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SecurityControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:keamanan.kbliperusahaan-index')->only('index');
        $this->middleware('permission:keamanan.assignapprove-index')->only('index');
    }

    public function assignApprove(Request $request)
    {
        $kbli_perusahaan = KbliPerusahaan::all();
        $user = User::all();
        $gambar_kbli_perusahaan = Gambar::all();
        $assignApprove = DB::table('assign_approve')
            ->select(
                'assign_approve.id as assign_approve_id',
                'assign_approve.approve_at',
                'approved_users.name as approved_by_name',
                'assign_approve.status',
                'assign_approve.perubahan',
                'assigned_users.name as assign_to_name',
                'assign_approve.assign_to',
                'assign_approve.data_terhapus',
                'assign_approve.delete_by',
                'deleted_user.name as delete_by_name',
                'assign_approve.delete_at',
                'assign_approve.approve_by',
                'assign_approve.kbli_perusahaan_id',
                'kbli_perusahaan.id as kbli_perusahaan_id_fk',
                'perusahaan_json.nama_perusahaan as nama_perusahaan_json',
                'assign_approve.created_at',
                'assign_approve.created_by',
                'created_by_users.name as created_by_name',
                'assign_approve.updated_at',
                'assign_approve.updated_by',
                'updated_by_users.name as updated_by_name',
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.longtitude'), '\"', '') as longtitude_json"),
                DB::raw("REPLACE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.latitude'), '\"', '') as latitude_json"),
                DB::raw("REPLACE(assign_approve.gambar_kbli_perusahaan_json, '\"', '') as gambar_json")
            )
            ->leftJoin('users as deleted_user', 'assign_approve.delete_by', '=', 'deleted_user.id')
            ->leftJoin('users as updated_by_users', 'assign_approve.updated_by', '=', 'updated_by_users.id')
            ->leftJoin('users as created_by_users', 'assign_approve.created_by', '=', 'created_by_users.id')
            ->leftJoin('users as assigned_users', 'assign_approve.assign_to', '=', 'assigned_users.id')
            ->leftJoin('users as approved_users', 'assign_approve.approve_by', '=', 'approved_users.id')
            ->leftJoin('kbli_perusahaan', 'assign_approve.kbli_perusahaan_id', '=', 'kbli_perusahaan.id')
            ->leftJoin('perusahaan as perusahaan_json', function ($join) {
                $join->on(
                    'perusahaan_json.id',
                    '=',
                    DB::raw("JSON_UNQUOTE(JSON_EXTRACT(assign_approve.kbli_perusahaan_json, '$.perusahaan_id'))")
                );
            })
            ->leftJoin('gambar_kbli_perusahaan', 'kbli_perusahaan.id', '=', 'gambar_kbli_perusahaan.kbli_perusahaan_id')
            ->leftJoin('gambar', 'gambar_kbli_perusahaan.gambar_id', '=', 'gambar.id')
            ->paginate(5);
        return view('keamanan.assignapprove-index')
            ->with([
                'kbli_perusahaan' => $kbli_perusahaan,
                'users' => $user,
                'assignApprove' => $assignApprove,
                'gambar_kbli_perusahaan' => $gambar_kbli_perusahaan
            ]);
    }

    public function kbliPerusahaan(Request $request)
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
                'perusahaan.nama_perusahaan as nama_perusahaan',
                'kbli.kbli as kbli',
                'kbli.judul_kbli as judul_kbli',
                'kbli.sektor as sektor',
                'kbli_perusahaan.kode_proyek as kode_proyek',
                'kbli_perusahaan.npwp as npwp',
                'kbli_perusahaan.data_terhapus',
                'kbli_perusahaan.delete_by',
                'delete_by_users.name as delete_by_name',
                'kbli_perusahaan.deleted_at',
                'kbli_perusahaan.updated_by',
                'updated_by_users.name as updated_by_name',
                'kbli_perusahaan.updated_at',
                'kbli_perusahaan.created_at',
                'kbli_perusahaan.created_by',
                'created_by_users.name as created_by_name',

            )
            ->leftJoin('users as updated_by_users', 'kbli_perusahaan.updated_by', '=', 'updated_by_users.id')
            ->leftJoin('users as created_by_users', 'kbli_perusahaan.created_by', '=', 'created_by_users.id')
            ->leftJoin('users as delete_by_users', 'kbli_perusahaan.delete_by', '=', 'delete_by_users.id')
            ->leftJoin('perusahaan', 'kbli_perusahaan.perusahaan_id', '=', 'perusahaan.id')
            ->leftJoin('kbli', 'kbli_perusahaan.kbli_id', '=', 'kbli.id')
            ->leftJoin('profile_pengusaha', 'kbli_perusahaan.profile_pengusaha_id', '=', 'profile_pengusaha.id')
            ->leftJoin('kabupaten as kab', function ($join) {
                $join->on('perusahaan.kabupaten_id', '=', 'kab.id');
            })
            ->leftJoin('uraian_jenis_perusahaan as ujp', function ($join) {
                $join->on('perusahaan.uraian_jenis_perusahaan_id', '=', 'ujp.id');
            })
            ->leftJoin('gambar_kbli_perusahaan', 'kbli_perusahaan.id', '=', 'gambar_kbli_perusahaan.kbli_perusahaan_id')
            ->leftJoin('gambar', 'gambar_kbli_perusahaan.gambar_id', '=', 'gambar.id')

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
            ->paginate(5);
        $kecamatanSelected = $request->input('kecamatan');
        $kelurahanSelected = $request->input('kelurahan');
        $kbliSelected = $request->input('kbli');
        $kbliperusahaansCount = $kbliperusahaans->total();

        return view('keamanan.kbliperusahaan-index')->with([
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
}
