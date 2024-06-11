<?php

namespace App\Http\Controllers;

use App\Exports\KategoriArtikelExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportKategoriArtikelRequest;
use App\Http\Requests\StoreKategoriArtikelRequest;
use App\Http\Requests\UpdateKategoriArtikelRequest;
use App\Imports\KategoriArtikelImport;
use Illuminate\Http\Request;

use App\Models\KategoriArtikel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use Str;

class KategoriArtikelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kategori-artikel.index')->only('index');
        $this->middleware('permission:kategori-artikel.create')->only('create', 'store');
        $this->middleware('permission:kategori-artikel.edit')->only('edit', 'update');
        $this->middleware('permission:kategori-artikel.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kategoriArtikel = DB::table('kategori_artikel')
        ->when($request->input('nama_kategori'), function ($query, $nama_kategori) {
            return $query->where('nama_kategori', 'like', '%' . $nama_kategori . '%');
        })
        ->paginate(5);
        return view('master-table.kategori-artikel.index',compact('kategoriArtikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master-table.kategori-artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKategoriArtikelRequest $request)
    {
        KategoriArtikel::create([
            'nama_kategori' => $request->nama_kategori
        ]);
        return redirect()->route('kategori-artikel.index')->with('success','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriArtikel $kategoriArtikel)
    {
        return view('master-table.kategori-artikel.edit',compact('kategoriArtikel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKategoriArtikelRequest $request, KategoriArtikel $kategoriArtikel)
    {
        $kategoriArtikel->update($request->all());
        return redirect()->route('kategori-artikel.index')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriArtikel $kategoriArtikel)
    {
        $kategoriArtikel->delete();
        return redirect()->route('kategori-artikel.index')->with('success','Data berhasil dihapus');
    }


    public function import(ImportKategoriArtikelRequest $request)
    {
        Excel::import(new KategoriArtikelImport, $request->file('import-file')->store('import-files'));
        return redirect()->route('kategori-artikel.index')->with('success', 'Tambahkan Data Kategori Artikel Sukses diimport');
    }

    public function export()
    {
        return Excel::download(new KategoriArtikelExport, 'kategori-artikel.xlsx');
    }
}
