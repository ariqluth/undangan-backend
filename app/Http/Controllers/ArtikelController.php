<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\ArtikelDeleteEvent;
use App\Exports\ArtikelExport;
use App\Http\Requests\ImportArtikelRequest;
use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use App\Jobs\ImportArtikelJob;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Illuminate\Support\Facades\Storage;
use DB;
use Str;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use File;

class ArtikelController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('permission:artikel.index')->only('index');
        $this->middleware('permission:artikel.create')->only('create', 'store');
        $this->middleware('permission:artikel.edit')->only('edit', 'update');
        $this->middleware('permission:artikel.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        $kategori = KategoriArtikel::all();
        $artikel = DB::table('artikel')
            ->select(
                'artikel.judul',
                'artikel.id',
                'artikel.thumbnail',
                'artikel.deskripsi',
                'artikel.path',
                'users.name as name',
                DB::raw('GROUP_CONCAT(kategori_artikel.nama_kategori SEPARATOR ", ") as kategori'),
                'artikel.slug'
            )
            ->leftJoin('users', 'artikel.penerbit_id', '=', 'users.id')
            ->join('artikel_kategori', 'artikel.id', '=', 'artikel_kategori.artikel_id')
            ->join('kategori_artikel', 'artikel_kategori.kategori_id', '=', 'kategori_artikel.id')
            ->when($request->input('judul'), function ($query, $judul) {
                return $query->where('artikel.judul', 'like', '%' . $judul . '%');
            })
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($request->input('kategori'), function ($query, $kategori) {
                return $query->where('kategori_artikel.nama_kategori', 'like', '%' . $kategori . '%');
            })
            ->groupBy('artikel.id', 'artikel.judul', 'artikel.thumbnail', 'users.name', 'artikel.slug', 'artikel.deskripsi')
            ->paginate(5);

        return view('master-table.artikel.index')->with([
            'artikels' => $artikel,
            'kategoris' => $kategori,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $KategoriArtikel = KategoriArtikel::all();
        $users = User::all();

        return view('master-table.artikel.create')->with([
            'KategoriArtikel' => $KategoriArtikel,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArtikelRequest $request)
    {
        $nama_thumbnail = 'default.jpg';

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $ori_name = $thumbnail->getClientOriginalName();
            $nama_thumbnail = $ori_name . '_' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->storeAs('', $nama_thumbnail, 'artikel');
            $path = str_replace('https://pusbakor.pacitankab.go.id/storage', '', Storage::disk('artikel')->url($nama_thumbnail));
        }

        $artikel = Artikel::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $nama_thumbnail,
            'path' => $path,
            'penerbit_id' => auth()->user()->id,
            'kategori_id' => $request->kategori_id,
            'slug' => Str::slug($request->judul),
        ]);

        $artikel->kategoriArtikel()->sync($request->kategori_id);

        return redirect()->route('artikel.index')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Artikel $artikel)
    {
        $KategoriArtikel = KategoriArtikel::all();
        $users = User::all();
        $artikels = DB::table('artikel')
            ->select(
                'artikel.judul',
                'artikel.id',
                'artikel.thumbnail',
                'artikel.path',
                'artikel.deskripsi',
                'users.name as name',
                DB::raw('GROUP_CONCAT(kategori_artikel.nama_kategori SEPARATOR ", ") as kategori'),
                'artikel.slug'
            )
            ->leftJoin('users', 'artikel.penerbit_id', '=', 'users.id')
            ->join('artikel_kategori', 'artikel.id', '=', 'artikel_kategori.artikel_id')
            ->join('kategori_artikel', 'artikel_kategori.kategori_id', '=', 'kategori_artikel.id')
            ->when($request->input('judul'), function ($query, $judul) {
                return $query->where('artikel.judul', 'like', '%' . $judul . '%');
            })
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($request->input('kategori'), function ($query, $kategori) {
                return $query->where('kategori_artikel.nama_kategori', 'like', '%' . $kategori . '%');
            })
            ->groupBy('artikel.id', 'artikel.judul', 'artikel.thumbnail', 'users.name', 'artikel.slug', 'artikel.deskripsi')
            ->paginate(5);

        $kategori_artikel = DB::table('artikel_kategori')
            ->join('kategori_artikel', 'artikel_kategori.kategori_id', '=', 'kategori_artikel.id')
            ->where('artikel_kategori.artikel_id', $artikel->id)
            ->select('kategori_artikel.nama_kategori')
            ->get();
        $kategori_list = $kategori_artikel->pluck('nama_kategori');


        $related_artikels = DB::table('artikel')
            ->select(
                'artikel.judul',
                'artikel.id',
                'artikel.thumbnail',
                'artikel.path',
                'artikel.deskripsi',
                'users.name as name',
                DB::raw('GROUP_CONCAT(kategori_artikel.nama_kategori SEPARATOR ", ") as kategori'),
                'artikel.slug'
            )
            ->leftJoin('users', 'artikel.penerbit_id', '=', 'users.id')
            ->join('artikel_kategori', 'artikel.id', '=', 'artikel_kategori.artikel_id')
            ->join('kategori_artikel', 'artikel_kategori.kategori_id', '=', 'kategori_artikel.id')
            ->where('artikel.id', '<>', $artikel->id) // Tambahkan baris ini
            ->whereIn('kategori_artikel.nama_kategori', $kategori_list) // Filter berdasarkan kategori
            ->groupBy('artikel.id', 'artikel.judul', 'artikel.thumbnail', 'users.name', 'artikel.slug', 'artikel.deskripsi')
            ->paginate(5);


        // dd($related_artikels);
        return view('master-table.artikel.show')->with([
            'artikel' => $artikel,
            'KategoriArtikel' => $KategoriArtikel,
            'users' => $users,
            'artikels' => $artikels,
            'related_artikels' => $related_artikels,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel)
    {
        $KategoriArtikel = KategoriArtikel::all();
        $users = User::all();

        return view('master-table.artikel.edit')->with([
            'artikel' => $artikel,
            'KategoriArtikel' => $KategoriArtikel,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtikelRequest $request, Artikel $artikel)
    {
        if ($request->hasFile('thumbnail')) {

            $oldThumbnail = $artikel->thumbnail;
            if ($oldThumbnail) {
                Storage::delete('public/assets/img/artikel/' . $oldThumbnail);
            }

            $thumbnail = $request->file('thumbnail');
            $ori_name = $thumbnail->getClientOriginalName();
            $nama_thumbnail = $ori_name . '_' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->storeAs('', $nama_thumbnail, 'artikel');
            $path = str_replace('https://pusbakor.pacitankab.go.id/storage', '', Storage::disk('artikel')->url($nama_thumbnail));

            $artikel->update([
                'thumbnail' => $nama_thumbnail,
                'path' => $path
            ]);
        }

        $artikel->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'penerbit_id' => auth()->user()->id,
            'slug' => Str::slug($request->judul),
        ]);

        $artikel->kategoriArtikel()->sync($request->kategori_id);
        return redirect()->route('artikel.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {

        event(new ArtikelDeleteEvent($artikel));

        $artikel->delete();
        return redirect()->route('artikel.index')->with('success', 'Data berhasil dihapus');
    }

    public function import(ImportArtikelRequest $request)
    {
        $filePath = $request->file('import-file')->store('import-files');
        ImportArtikelJob::dispatch(storage_path('app/' . $filePath));
        return redirect()->route('artikel.index')->with('success', 'Tambah Data Kbli Perusahaan Sukses diimport');
    }

    public function export()
    {
        return Excel::download(new ArtikelExport, 'Kbli Perusahaan.xlsx');
    }
}
