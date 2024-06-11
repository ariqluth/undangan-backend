<?php

namespace App\Http\Controllers;

use App\Exports\UraianResikoProyekExport;
use App\Http\Requests\ImportUraianResikoProyekRequest;
use App\Models\UraianResikoProyek;
use App\Http\Requests\StoreUraianResikoProyekRequest;
use App\Http\Requests\UpdateUraianResikoProyekRequest;
use App\Imports\UraianResikoProyekImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UraianResikoProyekController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:uraian-resiko-proyek.index')->only('index');
        $this->middleware('permission:uraian-resiko-proyek.create')->only('create', 'store');
        $this->middleware('permission:uraian-resiko-proyek.edit')->only('edit', 'update');
        $this->middleware('permission:uraian-resiko-proyek.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $uraian_resiko_proyeks = DB::table('uraian_resiko_proyek')
            ->when(
                $request->input('nama_uraian_resiko_proyek'),
                function ($query, $nama_uraian_resiko_proyek) {
                    return $query->where('nama_uraian_resiko_proyek', 'like', '%' . $nama_uraian_resiko_proyek . '%');
                }
            )->paginate(5);
        return view('master-table.uraian-resiko-proyek.index', compact('uraian_resiko_proyeks'));
    }

    public function create()
    {
        return view('master-table.uraian-resiko-proyek.create');
    }


    public function store(StoreUraianResikoProyekRequest $request)
    {
        UraianResikoProyek::create([
            'nama_uraian_resiko_proyek' => $request->nama_uraian_resiko_proyek,
        ]);
        return redirect()->route('uraian-resiko-proyek.index')->with('success', 'Tambah Data Uraian Resiko Proyek  Sukses');
    }

    public function show(UraianResikoProyek $uraianResikoProyek)
    {
        //
    }

    public function edit(UraianResikoProyek $uraian_resiko_proyek)
    {
        return view('master-table.uraian-resiko-proyek.edit')->with('uraian_resiko_proyek', $uraian_resiko_proyek);
    }

    public function update(UpdateUraianResikoProyekRequest $request, UraianResikoProyek $uraian_resiko_proyek)
    {
        $validate = $request->validated();
        $uraian_resiko_proyek->update($validate);
        return redirect()->route('uraian-resiko-proyek.index')->with('success', 'Edit Data Uraian Resiko Proyek Sukses');
    }

    public function destroy(UraianResikoProyek $uraian_resiko_proyek)
    {
        try {
            $uraian_resiko_proyek->delete();
            return redirect()->route('uraian-resiko-proyek.index')
                ->with('success', 'Hapus Data Uraian Resiko Proyek Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('uraian-resiko-proyek.index')
                    ->with('error', 'Tidak Dapat Menghapus Uraian Resiko Proyek Yang Masih Digunakan Oleh Kolom Lain');
            } else {
                return redirect()->route('uraian-resiko-proyek.index')
                    ->with('success', 'Hapus Data Uraian Resiko Proyek Sukses');
            }
        }
    }

    public function import(ImportUraianResikoProyekRequest  $request)
    {
        Excel::import(new UraianResikoProyekImport, $request->file('import-file')->store('import-files'));
        return redirect()->route('uraian-resiko-proyek.index')->with('success', 'Tambahkan Data Uraian Resiko Proyek Sukses diimport');
    }

    public function export()
    {
        return Excel::download(new UraianResikoProyekExport, 'Uraian Resiko Proyek.xlsx');
    }
}
