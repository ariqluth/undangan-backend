<?php

namespace App\Http\Controllers;

use App\Exports\PerusahaanExport;
use App\Http\Requests\ImportPerusahaanRequest;
use App\Http\Requests\StorePerusahaanRequest;
use App\Http\Requests\UpdatePerusahaanRequest;
use App\Imports\PerusahaanImport;
use App\Models\Perusahaan;
use App\Models\Kabupaten;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\PenanamanModal;
use App\Models\UraianJenisPerusahaan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class PerusahaanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:perusahaan.index')->only('index');
        $this->middleware('permission:perusahaan.create')->only('create', 'store');
        $this->middleware('permission:perusahaan.edit')->only('edit', 'update');
        $this->middleware('permission:perusahaan.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $perusahaans = DB::table('perusahaan')
            ->select(
                'perusahaan.*',
                'uraian_jenis_perusahaan.nama_uraian_jenis_perusahaan',
                'penanaman_modal.status_pmdn',
                'kabupaten.nama_kabupaten',
            )
            ->leftJoin('kabupaten', 'perusahaan.kabupaten_id', '=', 'kabupaten.id')
            ->leftJoin('penanaman_modal', 'perusahaan.penanaman_modal_id', '=', 'penanaman_modal.id')
            ->leftJoin('uraian_jenis_perusahaan', 'uraian_jenis_perusahaan_id', '=', 'uraian_jenis_perusahaan.id')
            ->when($request->input('nama_perusahaan'), function ($query, $nama_perusahaan) {
                return $query->where('perusahaan.nama_perusahaan', 'like', '%' . $nama_perusahaan . '%');
            })
            ->paginate(5);
        return view('data-table.perusahaan.index', compact('perusahaans'));
    }


    public function create()
    {
        $kabupatens = Kabupaten::all();
        $perusahaans = Perusahaan::all();
        $pemodalans = PenanamanModal::all();
        $uraianjenisperusahaans = UraianJenisPerusahaan::all();

        return view(
            'data-table.perusahaan.create'
        )->with([
            'uraianjenisperusahaans' => $uraianjenisperusahaans, 'pemodalans' => $pemodalans,
            'kabupatens' => $kabupatens, 'perusahaans' => $perusahaans
        ]);
    }


    public function store(StorePerusahaanRequest $request)
    {
        Perusahaan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'nib' => $request->nib,
            'penanaman_modal_id' => $request->penanaman_modal_id,
            'uraian_jenis_perusahaan_id' => $request->uraian_jenis_perusahaan_id,
            'alamat' => $request->alamat,
            'kabupaten_id' => $request->kabupaten_id,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
        ]);
        return redirect()->route('perusahaan.index')->with('success', 'Tambah Data Perusahaan Sukses');
    }


    public function show(Perusahaan $perusahaan)
    {
        //
    }


    public function edit(Perusahaan $perusahaan)
    {
        $kabupatens = Kabupaten::all();
        $pemodalans = PenanamanModal::all();
        $uraianjenisperusahaans = UraianJenisPerusahaan::all();
        return view('data-table.perusahaan.edit')
            ->with([
                'pemodalans' => $pemodalans, 'uraianjenisperusahaans' => $uraianjenisperusahaans,
                'kabupatens' => $kabupatens, 'perusahaan' => $perusahaan
            ]);
    }


    public function update(UpdatePerusahaanRequest $request, Perusahaan $perusahaan)
    {
        $validate = $request->validated();
        $perusahaan->update($validate);
        return redirect()->route('perusahaan.index')
            ->with('success', 'Edit Data Perusahaan Sukses');
    }


    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();
        return redirect()->route('perusahaan.index')
            ->with('success', 'Hapus Data Perusahaan Sukses');
    }

    public function import(ImportPerusahaanRequest $request)
    {
        Excel::import(new PerusahaanImport, $request->file('import-file')->store('import-files'));
        return redirect()->route('perusahaan.index')->with('success', 'Tambah Data Perusahaan Sukses diimport');
    }

    public function export()
    {
        return Excel::download(new PerusahaanExport, 'Perusahaan.xlsx');
    }


}
