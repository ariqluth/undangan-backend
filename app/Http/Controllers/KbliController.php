<?php

namespace App\Http\Controllers;

use App\Exports\KblisExport;
use App\Http\Requests\ImportKbliRequest;
use App\Http\Requests\StoreKbliRequest;
use App\Http\Requests\UpdateKbliRequest;
use App\Imports\KblisImport;
use App\Models\Kbli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KbliController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kbli.index')->only('index');
        $this->middleware('permission:kbli.create')->only('create', 'store');
        $this->middleware('permission:kbli.edit')->only('edit', 'update');
        $this->middleware('permission:kbli.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $kblis = DB::table('kbli')
            ->when($request->input('judul_kbli'), function ($query, $judul_kbli) {
                return $query->where('judul_kbli', 'like', '%' . $judul_kbli . '%');
            })
            ->paginate(5);
        return view('master-table.kbli.index', compact('kblis'));
    }


    public function create()
    {
        return view('master-table.kbli.create');
    }

    public function store(StoreKbliRequest $request)
    {
        Kbli::create([
            'kbli' => $request->kbli,
            'judul_kbli' => $request->judul_kbli,
            'sektor' => $request->sektor
        ]);
        return redirect()->route('kbli.index')->with('success', 'Tambah Data Kbli Sukses');
    }

    public function show(Kbli $kbli)
    {
        //
    }

    public function edit(Kbli $kbli)
    {
        return view('master-table.kbli.edit')->with('kbli', $kbli);
    }

    public function update(UpdateKbliRequest $request, Kbli $kbli)
    {
        $validate = $request->validated();
        $kbli->update($validate);
        return redirect()->route('kbli.index')->with('success', 'Edit Data Kbli Sukses');
    }

    public function destroy(Kbli $kbli)
    {
        try {
            $kbli->delete();
            return redirect()->route('kbli.index')
                ->with('success', 'Hapus Data Kbli Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('kbli.index')
                    ->with('error', 'Tidak Dapat Menghapus Kbli Yang Masih Digunakan Oleh Kolom Lain');
            } else {
                return redirect()->route('kbli.index')
                    ->with('success', 'Hapus Data Kbli Sukses');
            }
        }
    }

    public function import(ImportKbliRequest $request)
    {
        Excel::import(new KblisImport, $request->file('import-file')->store('import-files'));
        return redirect()->route('kbli.index')->with('success', 'Tambahkan Data Kbli Sukses diimport');
    }

    public function export()
    {
        return Excel::download(new KblisExport, 'kbli.xlsx');
    }
}
