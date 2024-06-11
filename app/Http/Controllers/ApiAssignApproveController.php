<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAssignApproveKbliPerusahaanAPI;
use App\Http\Requests\UpdateAssignApprove;
use App\Http\Requests\UpdateKbliPerusahaanRequest;
use App\Http\Resources\AssignApproveResource;
use App\Models\AssignApprove;
use App\Models\GambarKbliPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApiAssignApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignApprove = DB::table('assign_approve')
            ->select(
                'assign_approve.assign_to',
                'users.name',
                'assign_approve.status',
                'assign_approve.perubahan',
                'assign_approve.kbli_perusahaan_id',
                'kbli_perusahaan.id',
                'kbli_perusahaan.perusahaan_id',
                'perusahaan.nama_perusahaan',
                'perusahaan.nib',
                'perusahaan.penanaman_modal_id',
                'penanaman_modal.status_pmdn',
                'perusahaan.uraian_jenis_perusahaan_id',
                'uraian_jenis_perusahaan.nama_uraian_jenis_perusahaan',
                'perusahaan.alamat',
                'perusahaan.kabupaten_id',
                'kabupaten.nama_kabupaten',
                'perusahaan.email',
                'perusahaan.no_telp',
                'kbli_perusahaan.npwp',
                'kbli_perusahaan.kode_proyek',
                'kbli_perusahaan.kbli_id',
                'kbli.kbli',
                'kbli.judul_kbli',
                'kbli.sektor',
                'kbli_perusahaan.uraian_resiko_proyek_id',
                'uraian_resiko_proyek.nama_uraian_resiko_proyek',
                'kbli_perusahaan.uraian_skala_usaha_id',
                'uraian_skala_usaha.nama_uraian_skala_usaha',
                'kbli_perusahaan.alamat',
                'kbli_perusahaan.kecamatan_id',
                'kecamatan.nama_kecamatan',
                'kbli_perusahaan.kelurahan_id',
                'kelurahan.nama_kelurahan',
                'kbli_perusahaan.longtitude',
                'kbli_perusahaan.latitude',
                'kbli_perusahaan.profile_pengusaha_id',
                'profile_pengusaha.nomor_identitas_user',
                'profile_pengusaha.nama_pengusaha',
                'profile_pengusaha.no_telp',
                'profile_pengusaha.email',
                'kbli_perusahaan.mesin_peralatan',
                'kbli_perusahaan.mesin_peralatan_impor',
                'kbli_perusahaan.pembelian_pematangan_tanah',
                'kbli_perusahaan.bangunan_gedung',
                'kbli_perusahaan.lain_lain',
                'kbli_perusahaan.modal_kerja',
                'kbli_perusahaan.jumlah_investasi',
                'kbli_perusahaan.tenaga_kerja',
                'gambar_kbli_perusahaan.gambar',
            )
            ->leftJoin('kbli_perusahaan', 'assign_approve.kbli_perusahaan_id', '=', 'kbli_perusahaan.id')
            ->leftJoin('gambar_kbli_perusahaan', 'assign_approve.kbli_perusahaan_id', '=', 'gambar_kbli_perusahaan.kbli_perusahaan_id')
            ->leftJoin('kbli', 'kbli_perusahaan.kbli_id', '=', 'kbli.id')
            ->leftJoin('perusahaan', 'kbli_perusahaan.perusahaan_id', '=', 'perusahaan.id')
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
            ->leftJoin('kecamatan', 'kbli_perusahaan.kecamatan_id', '=', 'kecamatan.id')
            ->leftJoin('kelurahan', 'kbli_perusahaan.kelurahan_id', '=', 'kelurahan.id')
            ->leftJoin('uraian_resiko_proyek', 'uraian_resiko_proyek_id', '=', 'uraian_resiko_proyek.id')
            ->leftJoin('uraian_skala_usaha', 'uraian_skala_usaha_id', '=', 'uraian_skala_usaha.id')
            ->leftJoin('kabupaten', 'perusahaan.kabupaten_id', '=', 'kabupaten.id')
            ->leftJoin('penanaman_modal', 'perusahaan.penanaman_modal_id', '=', 'penanaman_modal.id')
            ->leftJoin('uraian_jenis_perusahaan', 'uraian_jenis_perusahaan_id', '=', 'uraian_jenis_perusahaan.id')
            ->leftJoin('users', 'assign_approve.assign_to', '=', 'users.id')
            ->paginate(5);
        // dd($assignApprove);
        return AssignApproveResource::collection($assignApprove);
    }

    public function getAssignApproveByUser($user_id)
    {
        $assign_approves = AssignApprove::where([
            ['assign_to', $user_id],
        ])->paginate(10000);

        return AssignApproveResource::collection($assign_approves);
    }

    public function getListWaitApproveByUser($user_id)
    {
        $assign_approves = AssignApprove::where([
            ['assign_to', $user_id],
            ['perubahan', 'terubah'],
        ])->paginate(1000);

        return AssignApproveResource::collection($assign_approves);
    }

    // public function update(Request $request, AssignApprove $assignApprove)
    // {
    //     if ($assignApprove->status === 'approved') {
    //         return response()->json(['message' => 'Data cannot be updated because the status is Approved.'], 422);
    //     }
    //     $validated = $request->validated();
    //     $validated['assignApproveID'] = $assignApprove->id;

    // // handle gambar upload
    // if ($request->hasFile('gambar')) {
    //     $gambar = $request->file('gambar');
    //     $valid_extensions = ['jpg', 'jpeg', 'png'];
    //     if (!in_array(strtolower($gambar->getClientOriginalExtension()), $valid_extensions)) {
    //         return response()->json(['message' => 'The gambar must be a file of type: jpeg, png, jpg.'], 422);
    //     }
    //     $nama_gambar = $gambar->getClientOriginalName();
    //     $nama_gambar_baru = uniqid() . '_' . $nama_gambar;
    //     Storage::putFileAs('public/assets/img/api', $gambar, $nama_gambar_baru);
    //     $validated['gambar'] = $nama_gambar_baru;
    // } else {
    //     $validated['gambar'] = $assignApprove->kbli_perusahaan_gambar;
    // }
    //     $assignApprove->kbli_perusahaan_json = json_encode($validated);
    //     $assignApprove->perubahan = 'terubah';
    //     $assignApprove->save();
    //     return response()->json(['message' => 'Data updated successfully.']);
    // }

    public function update(UpdateAssignApprove $request, AssignApprove $assignApprove)
    {
        if ($assignApprove->status === 'approved') {
            return response()->json(['message' => 'Data cannot be updated because the status is Approved.'], 422);
        }

        $validated = $request->validated();
        $validated['assignApproveID'] = $assignApprove->id;
        $assignApprove->kbli_perusahaan_json = json_encode($validated);
        $assignApprove->perubahan = 'terubah';
        $assignApprove->save();

        return response()->json(['message' => 'Data updated successfully.']);
    }

    public function uploadFoto(Request $request, AssignApprove $assignApprove)
    {
        if ($assignApprove->status === 'approved') {
            return response()->json(['message' => 'Data cannot be updated because the status is Approved.'], 422);
        }

        if (!$request->hasFile('gambar')) {
            return response()->json(['message' => 'No file was provided.'], 422);
        }

        $gambar = $request->file('gambar');
        $valid_extensions = ['jpg', 'jpeg', 'png'];

        if (!in_array(strtolower($gambar->getClientOriginalExtension()), $valid_extensions)) {
            return response()->json(['message' => 'The gambar must be a file of type: jpeg, png, jpg.'], 422);
        }

        $nama_gambar = $gambar->getClientOriginalName();
        $nama_gambar_baru = uniqid() . '_' . $nama_gambar;
        Storage::disk('assign_approve_mobile')->putFileAs('/', $gambar, $nama_gambar_baru);

        // Update kolom gambar pada $assignApprove dengan nama gambar baru yang dihasilkan
        $assignApprove->perubahan = 'terubah';

        $assignApprove->gambar_kbli_perusahaan_json = json_encode($nama_gambar_baru);
        $assignApprove->save();

        return response()->json(['message' => 'Gambar uploaded successfully.']);
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
     * @param  \App\Models\AssignApprove  $assignApprove
     * @return \Illuminate\Http\Response
     */
    public function show(AssignApprove $assignApprove)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignApprove  $assignApprove
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignApprove  $assignApprove
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignApprove $assignApprove)
    {
        //
    }
}
