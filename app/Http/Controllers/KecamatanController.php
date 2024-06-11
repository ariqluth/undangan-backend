<?php

namespace App\Http\Controllers;

use App\Exports\KecamatansExport;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Http\Requests\StoreKecamatanRequest;
use App\Http\Requests\UpdateKecamatanRequest;
use App\Http\Requests\ImportKecamatanRequest;
use App\Imports\KecamatansImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KecamatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kecamatan.index')->only('index');
        $this->middleware('permission:kecamatan.create')->only('create', 'store');
        $this->middleware('permission:kecamatan.edit')->only('edit', 'update');
        $this->middleware('permission:kecamatan.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $kecamatans = DB::table('kecamatan')
            ->select('kecamatan.*', 'kabupaten.nama_kabupaten as nama_kabupaten')
            ->leftJoin('kabupaten', 'kecamatan.kabupaten_id', '=', 'kabupaten.id')
            ->when($request->input('nama_kecamatan'), function ($query, $nama_kecamatan) {
                return $query->where('kecamatan.nama_kecamatan', 'like', '%' . $nama_kecamatan . '%');
            })
            ->when($request->input('nama_kabupaten'), function ($query, $nama_kabupaten) {
                return $query->where('nama_kabupaten', 'like', '%' . $nama_kabupaten . '%');
            })
            ->paginate(5);
        return view('master-table.kecamatan.index', compact('kecamatans'));
    }

    public function create()
    {
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        return view('master-table.kecamatan.create', compact('kabupatens', 'kecamatans'));
    }

    public function store(StoreKecamatanRequest $request)
    {
        Kecamatan::create([
            'nama_kecamatan' => $request->nama_kecamatan,
            'kabupaten_id' => $request->kabupaten_id,
        ]);
        return redirect()->route('kecamatan.index')->with('success', 'Tambah Data Kecamatan Sukses');
    }

    public function show(Kecamatan $kecamatan)
    {
        //
    }

    public function edit(Kecamatan $kecamatan)
    {
        $kabupaten = Kabupaten::all();

        return view('master-table.kecamatan.edit',)
            ->with(['kecamatan' => $kecamatan, 'kabupaten' => $kabupaten]);
    }

    public function update(UpdateKecamatanRequest $request, Kecamatan $kecamatan)
    {
        $validate = $request->validated();
        $kecamatan->update($validate);
        return redirect()->route('kecamatan.index')->with('success', 'Edit Data Kecamatan Sukses');
    }

    public function destroy(Kecamatan $kecamatan)
    {
        try {
            $kecamatan->delete();
            return redirect()->route('kecamatan.index')->with('success', 'Hapus Data Kecamatan Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('kecamatan.index')
                    ->with('error', 'Tidak Dapat Menghapus Kecamatan Yang Masih Digunakan Oleh Kolom Lain');
            } else {
                return redirect()->route('kecamatan.index')->with('success', 'Hapus Data Kecamatan Sukses');
            }
        }
    }

    public function import(ImportKecamatanRequest $request)
    {
        Excel::import(new KecamatansImport(), $request->file('import-file')->store('import-files'));
        return redirect()->route('kecamatan.index');
    }

    public function export()
    {
        return Excel::download(new KecamatansExport, 'Kecamatan.xlsx');
    }
}
