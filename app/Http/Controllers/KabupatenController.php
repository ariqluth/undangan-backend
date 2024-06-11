<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Http\Requests\StoreKabupatenRequest;
use App\Http\Requests\UpdateKabupatenRequest;
use App\Http\Requests\ImportKabupatenRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KabupatensExport;
use App\Imports\KabupatensImport;

class KabupatenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kabupaten.index')->only('index');
        $this->middleware('permission:kabupaten.create')->only('create', 'store');
        $this->middleware('permission:kabupaten.edit')->only('edit', 'update');
        $this->middleware('permission:kabupaten.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $kabupatens = DB::table('kabupaten')
            ->when($request->input('nama_kabupaten'), function ($query, $nama_kabupaten) {
                return $query->where('nama_kabupaten', 'like', '%' . $nama_kabupaten . '%');
            }) 
            ->paginate(5);
        return view('master-table.kabupaten.index', compact('kabupatens'));
    }

    public function create()
    {
        return view('master-table.kabupaten.create');
    }

    public function store(StoreKabupatenRequest $request)
    {
        Kabupaten::create([
            'nama_kabupaten' => $request->nama_kabupaten
        ]);
        return redirect()->route('kabupaten.index')->with('success', 'Tambah Data Kabupaten Sukses');
    }

    public function show(Kabupaten $kabupaten)
    {
        //
    }

    public function edit(Kabupaten $kabupaten)
    {
        return view('master-table.kabupaten.edit')->with('kabupaten', $kabupaten);
    }

    public function update(UpdateKabupatenRequest $request, Kabupaten $kabupaten)
    {
        $validate = $request->validated();
        $kabupaten->update($validate);
        return redirect()->route('kabupaten.index')->with('success', 'Edit Data Kabupaten Sukses');
    }

    public function destroy(Kabupaten $kabupaten)
    {
        try {
            $kabupaten->delete();
            return redirect()->route('kabupaten.index')->with('success', 'Hapus Data Kabupaten Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('kabupaten.index')
                    ->with('error', 'Tidak Dapat Menghapus Kabupaten Yang Masih Digunakan Oleh Kolom Lain');
            } else {
                return redirect()->route('kabupaten.index')->with('success', 'Hapus Data Kabupaten Sukses');
            }
        }
    }


    public function import(ImportKabupatenRequest $request)
    {
        Excel::import(new KabupatensImport, $request->file('import-file')->store('import-files'));
        return redirect()->route('kabupaten.index')->with('success', 'Tambahkan Data Kabupaten Sukses diimport');
    }

    public function export()
    {
        return Excel::download(new KabupatensExport, 'Kabupaten.xlsx');
    }
}
