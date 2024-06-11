<?php

namespace App\Http\Controllers;

use App\Models\ProfilePengusaha;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProfilePengusahaRequest;
use App\Http\Requests\UpdateProfilePengusahaRequest;
use App\Http\Requests\ImportProfilePengusahaRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProfilePengusahaImport;
use App\Exports\ProfilePengusahaExport;


class ProfilePengusahaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:profile-pengusaha.index')->only('index');
        $this->middleware('permission:profile-pengusaha.create')->only('create', 'store');
        $this->middleware('permission:profile-pengusaha.edit')->only('edit', 'update');
        $this->middleware('permission:profile-pengusaha.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $profile_pengusahas = DB::table('profile_pengusaha')
            ->select('profile_pengusaha.*')
            ->when($request->input('nama_pengusaha'), function ($query, $nama_pengusaha) {
                return $query->where('nama_pengusaha', 'like', '%' . $nama_pengusaha . '%');
            })
            ->paginate(5);
        return view('data-table.profile-pengusaha.index', compact('profile_pengusahas'));
    }

    public function create()
    {
        return view('data-table.profile-pengusaha.create');
    }

    public function store(StoreProfilePengusahaRequest $request)
    {
        ProfilePengusaha::create([
            'nomor_identitas_user' => $request['nomor_identitas_user'],
            'nama_pengusaha' => $request['nama_pengusaha'],
            'no_telp' => $request['no_telp'],
            'email' => $request['email'],
        ]);
        return redirect(route('profile-pengusaha.index'))->with('success', 'Tambah Data Pengusaha Sukses');
    }


    public function show(ProfilePengusaha $profile_pengusaha)
    {
        //
    }


    public function edit(ProfilePengusaha $profile_pengusaha)
    {
        return view('data-table.profile-pengusaha.edit')->with('profile_pengusaha', $profile_pengusaha);
    }


    public function update(UpdateProfilePengusahaRequest $request, ProfilePengusaha $profile_pengusaha)
    {
        $validate = $request->validated();
        $profile_pengusaha->update($validate);
        return redirect()->route('profile-pengusaha.index')->with('success', 'Edit Data Pengusaha Sukses');
    }

    public function destroy(ProfilePengusaha $profile_pengusaha)
    {
        try {
            $profile_pengusaha->delete();

            return redirect()->route('profile-pengusaha.index')->with('success', 'Hapus Data Pengusaha Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('profile-pengusaha.index')
                    ->with('error', 'Tidak Dapat Menghapus Pengusaha Yang Masih Digunakan Oleh Kolom Lain');
            } else {
                return redirect()->route('profile-pengusaha.index')->with('success', 'Hapus Data Pengusaha Sukses');
            }
        }
    }

    public function import(ImportProfilePengusahaRequest $request)
    {
        Excel::import(new ProfilePengusahaImport, $request->file('import-file')->store('import-files'));
        return redirect()->route('profile-pengusaha.index')->with('success', 'Tambah Data Pengusaha Sukses diimport');
    }

    public function export()
    {
        return Excel::download(new ProfilePengusahaExport, 'Profile Pengusaha.xlsx');
    }
}
