<?php

namespace App\Http\Controllers;

use App\Exports\UraianSkalaUsahaExport;
use App\Http\Requests\ImportUraianSkalaUsahaRequest;
use App\Models\UraianSkalaUsaha;
use App\Http\Requests\StoreUraianSkalaUsahaRequest;
use App\Http\Requests\UpdateUraianSkalaUsahaRequest;
use App\Imports\UraianSkalaUsahaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UraianSkalaUsahaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:uraian-skala-usaha.index')->only('index');
        $this->middleware('permission:uraian-skala-usaha.create')->only('create', 'store');
        $this->middleware('permission:uraian-skala-usaha.edit')->only('edit', 'update');
        $this->middleware('permission:uraian-skala-usaha.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $uraian_skala_usahas = DB::table('uraian_skala_usaha')
            ->when(
                $request->input('nama_uraian_skala_usaha'),
                function ($query, $nama_uraian_skala_usaha) {
                    return $query->where('nama_uraian_skala_usaha', 'like', '%' . $nama_uraian_skala_usaha . '%');
                }
            )->paginate(5);
        return view('master-table.uraian-skala-usaha.index', compact('uraian_skala_usahas'));
    }

    public function create()
    {
        return view('master-table.uraian-skala-usaha.create');
    }

    public function store(StoreUraianSkalaUsahaRequest $request)
    {
        UraianSkalaUsaha::create([
            'nama_uraian_skala_usaha' => $request->nama_uraian_skala_usaha,
        ]);
        return redirect()->route('uraian-skala-usaha.index')->with('success', 'Tambah Data Uraian Skala Usaha  Sukses');
    }

    public function show(UraianSkalaUsaha $uraian_skala_usaha)
    {
        //
    }

    public function edit(UraianSkalaUsaha $uraian_skala_usaha)
    {
        return view('master-table.uraian-skala-usaha.edit')->with('uraian_skala_usaha', $uraian_skala_usaha);
    }

    public function update(UpdateUraianSkalaUsahaRequest $request, UraianSkalaUsaha $uraian_skala_usaha)
    {
        $validate = $request->validated();
        $uraian_skala_usaha->update($validate);
        return redirect()->route('uraian-skala-usaha.index')->with('success', 'Edit Data Uraian Skala Usaha Sukses');
    }

    public function destroy(UraianSkalaUsaha $uraian_skala_usaha)
    {
        try {
            $uraian_skala_usaha->delete();
            return redirect()->route('uraian-skala-usaha.index')->with('success', 'Hapus Data Uraian Skala Usaha Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()
                    ->route('uraian-skala-usaha.index')
                    ->with('error', 'Tidak Dapat Menghapus Uraian Skala Usaha Yang Masih Digunakan Oleh Kolom Lain');
            } else {
                return redirect()->route('uraian-skala-usaha.index')->with('success', 'Hapus Data Uraian Skala Usaha Sukses');
            }
        }
    }

    public function import(ImportUraianSkalaUsahaRequest  $request)
    {
        Excel::import(new UraianSkalaUsahaImport, $request->file('import-file')->store('import-files'));
        return redirect()->route('uraian-skala-usaha.index')->with('success', 'Tambahkan Data Uraian Skala Usaha Sukses diimport');
    }

    public function export()
    {
        return Excel::download(new UraianSkalaUsahaExport, 'Uraian Skala Usaha.xlsx');
    }
}
