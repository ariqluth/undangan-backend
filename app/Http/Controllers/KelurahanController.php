<?php

namespace App\Http\Controllers;

use App\Exports\KelurahansExport;
use App\Models\Kabupaten;
use App\Models\Kelurahan;
use App\Http\Requests\StoreKelurahanRequest;
use App\Http\Requests\UpdateKelurahanRequest;
use App\Http\Requests\ImportKelurahanRequest;
use App\Imports\KelurahansImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kecamatan;
use Maatwebsite\Excel\Facades\Excel;

class KelurahanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kelurahan.index')->only('index');
        $this->middleware('permission:kelurahan.create')->only('create', 'store');
        $this->middleware('permission:kelurahan.edit')->only('edit', 'update');
        $this->middleware('permission:kelurahan.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $kelurahans = DB::table('kelurahan')
            ->select('kelurahan.*', 'kecamatan.nama_kecamatan as nama_kecamatan', 'kabupaten.nama_kabupaten as nama_kabupaten')
            ->leftJoin('kecamatan', 'kelurahan.kecamatan_id', '=', 'kecamatan.id')
            ->leftJoin('kabupaten', 'kelurahan.kabupaten_id', '=', 'kabupaten.id')
            ->when($request->input('nama_kelurahan'), function ($query, $nama_kelurahan) {
                return $query->where('kelurahan.nama_kelurahan', 'like', '%' . $nama_kelurahan . '%');
            })
            ->when($request->input('kecamatan'), function ($query, $kecamatan) {
                return $query->whereIn('kelurahan.kecamatan_id', $kecamatan);
            })
            ->when($request->input('kabupaten'), function ($query, $kabupaten) {
                return $query->where('kelurahan.kabupaten_id', $kabupaten);
            })
            ->paginate(5);
        return view('master-table.kelurahan.index')
            ->with([
                'kabupatens' => $kabupatens,
                'kecamatans' => $kecamatans,
                'kelurahans' => $kelurahans,
            ]);
    }

    public function create()
    {
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $kelurahans = Kelurahan::all();

        return view(
            'master-table.kelurahan.create'
        )->with(['kelurahans' => $kelurahans, 'kecamatans' => $kecamatans, 'kabupatens' => $kabupatens]);
    }

    public function store(StoreKelurahanRequest $request)
    {
        Kelurahan::create([
            'nama_kelurahan' => $request->nama_kelurahan,
            'kabupaten_id' => $request->kabupaten_id,
            'kecamatan_id' => $request->kecamatan_id,
            'status' => $request->status,
        ]);
        return redirect()->route('kelurahan.index')->with('success', 'Tambah Data Kelurahan Sukses');
    }

    public function show(Kelurahan $kelurahan)
    {
        //
    }

    public function edit(Kelurahan $kelurahan)
    {
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        return view('master-table.kelurahan.edit')
            ->with(['kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'kabupaten' => $kabupaten]);
    }

    public function update(UpdateKelurahanRequest $request, Kelurahan $kelurahan)
    {
        $validate = $request->validated();
        $kelurahan->update($validate);
        return redirect()->route('kelurahan.index')->with('success', 'Edit Data Kelurahan Sukses');
    }

    public function destroy(Kelurahan $kelurahan)
    {
        try {
            $kelurahan->delete();
            return redirect()->route('kelurahan.index')->with('success', 'Hapus Data Kelurahan Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('kelurahan.index')
                    ->with('error', 'Tidak Dapat Menghapus Kelurahan Yang Masih Digunakan Oleh Kolom Lain');
            } else {
                return redirect()->route('kelurahan.index')->with('success', 'Hapus Data Kelurahan Sukses');
            }
        }
    }

    public function import(ImportKelurahanRequest $request)
    {
        Excel::import(new KelurahansImport, $request->file('import-file')->store('import-files'));
        return redirect()->route('kelurahan.index');
    }

    public function export()
    {
        return Excel::download(new KelurahansExport, 'Kelurahan.xlsx');
    }

    public function kecamatanFilter(Request $request)
    {
        $kecamatan['Kecamatan'] = Kecamatan::all()->where('kabupaten_id', $request->id);
        return response()->json($kecamatan);
    }

    public function kecamataneditFilter(Request $request)
    {
        $kecamatan['Kecamatan'] = Kecamatan::all()->where('kabupaten_id', $request->id);
        return response()->json($kecamatan);
    }
}
