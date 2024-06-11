<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtikelRequest as Request;
use App\Http\Controllers\ArtikelController;
use App\Models\KategoriArtikel;
use Str;
use App\Models\User;

use App\Models\Artikel;
use DB;

class  VisitorArtikelController extends Controller
{
    public function index()
    {
        //
    }

    public function show(Request $request)
    {
        $users = User::all();
        $kategori = KategoriArtikel::all();
        $artikel = DB::table('artikel')
            ->select(
                'artikel.judul',
                'artikel.id',
                'artikel.thumbnail',
                'artikel.updated_at',
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
            ->groupBy('artikel.id', 'artikel.judul', 'artikel.thumbnail', 'users.name', 'artikel.slug', 'artikel.deskripsi', 'artikel.updated_at')
            ->paginate(5);

        return view('visitor.show')->with([
            'artikel' => $artikel,
            'kategoris' => $kategori,
            'users' => $users,
        ]);
    }

    public function detail(Request $request, string $slug)
    {
        $artikel = Artikel::where('slug', $slug)
            ->leftJoin('users', 'artikel.penerbit_id', '=', 'users.id')
            ->select(
                'artikel.judul',
                'artikel.id',
                'artikel.path',
                'artikel.thumbnail',
                'artikel.deskripsi',
                'artikel.updated_at',
                'users.name as name'
            )
            ->firstOrFail();
        // dd($artikel);
        $KategoriArtikel = KategoriArtikel::all();
        $users = User::all();
        $artikels = DB::table('artikel')->select(
            'artikel.judul',
            'artikel.id',
            'artikel.path',
            'artikel.thumbnail',
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
            ->groupBy('artikel.id', 'artikel.judul', 'artikel.thumbnail', 'users.name', 'artikel.slug', 'artikel.deskripsi', 'artikel.updated_at')
            ->paginate(5);
        // dd($artikel);

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
                'artikel.path',
                'artikel.thumbnail',
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
            ->groupBy('artikel.id', 'artikel.judul', 'artikel.thumbnail', 'users.name', 'artikel.slug', 'artikel.deskripsi', 'artikel.updated_at')
            ->paginate(5);

        return view('visitor.detail')->with([
            'artikel' => $artikel,
            'KategoriArtikel' => $KategoriArtikel,
            'users' => $users,
            'artikels' => $artikels,
            'related_artikels' => $related_artikels,
        ]);
    }
}
