<?php

namespace App\Http\Controllers;

use App\Exports\UraianJenisPerusahaanExport;
use App\Http\Requests\ImportUraianJenisPerusahaanRequest;
use App\Models\UraianJenisPerusahaan;
use App\Http\Requests\StoreUraianJenisPerusahaanRequest;
use App\Http\Requests\UpdateUraianJenisPerusahaanRequest;
use App\Imports\UraianJenisPerusahaanImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class UraianJenisPerusahaanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:uraian-jenis-perusahaan.index')->only('index');
        $this->middleware('permission:uraian-jenis-perusahaan.create')->only('create', 'store');
        $this->middleware('permission:uraian-jenis-perusahaan.edit')->only('edit', 'update');
        $this->middleware('permission:uraian-jenis-perusahaan.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $uraian_jenis_perusahaans = DB::table('uraian_jenis_perusahaan')
            ->when(
                $request->input('nama_uraian_jenis_perusahaan'),
                function ($query, $nama_uraian_jenis_perusahaan) {
                    return $query->where('nama_uraian_jenis_perusahaan', 'like', '%' . $nama_uraian_jenis_perusahaan . '%');
                }
            )->paginate(5);
        return view('master-table.uraian-jenis-perusahaan.index', compact('uraian_jenis_perusahaans'));
    }


    public function create()
    {
        return view('master-table.uraian-jenis-perusahaan.create');
    }


    public function store(StoreUraianJenisPerusahaanRequest $request)
    {
        UraianJenisPerusahaan::create([
            'nama_uraian_jenis_perusahaan' => $request->nama_uraian_jenis_perusahaan
        ]);
        return redirect()->route('uraian-jenis-perusahaan.index')->with('success', 'Tambah Data Uraian Jenis Perusahaan Sukses');
    }


    public function show(UraianJenisPerusahaan $uraian_jenis_perusahaan)
    {
    }


    public function edit(UraianJenisPerusahaan $uraian_jenis_perusahaan)
    {
        return view('master-table.uraian-jenis-perusahaan.edit')->with('uraian_jenis_perusahaan', $uraian_jenis_perusahaan);
    }

    public function update(UpdateUraianJenisPerusahaanRequest $request, UraianJenisPerusahaan $uraian_jenis_perusahaan)
    {
        $validate = $request->validated();
        $uraian_jenis_perusahaan->update($validate);
        return redirect()->route('uraian-jenis-perusahaan.index')->with('success', 'Edit Data Uraian Jenis Perusahaan Sukses');
    }

    public function destroy(UraianJenisPerusahaan $uraian_jenis_perusahaan)
    {
        try {
            $uraian_jenis_perusahaan->delete();
            return redirect()->route('uraian-jenis-perusahaan.index')
                ->with('success', 'Hapus Data Uraian Jenis Perusahaan Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()
                    ->route('uraian-jenis-perusahaan.index')
                    ->with('error', 'Tidak Dapat Menghapus Uraian Jenis Perusahaan Yang Masih Digunakan Oleh Kolom Lain');
            } else {
                return redirect()->route('uraian-jenis-perusahaan.index')
                    ->with('success', 'Hapus Data Uraian Jenis Perusahaan Sukses');
            }
        }
    }

    public function import(ImportUraianJenisPerusahaanRequest  $request)
    {
        Excel::import(new UraianJenisPerusahaanImport, $request->file('import-file')->store('import-files'));
        return redirect()->route(
            'uraian-jenis-perusahaan.index'
        )->with('success', 'Tambahkan Data Uraian Jenis Perusahaan Sukses diimport');
    }

    public function export()
    {
        return Excel::download(new UraianJenisPerusahaanExport, 'Uraian Jenis Perusahaan.xlsx');
    }
}
