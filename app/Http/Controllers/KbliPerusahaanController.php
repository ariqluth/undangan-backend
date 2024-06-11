<?php

namespace App\Http\Controllers;

use App\Jobs\ImportKbliPerusahaanJob;

use App\Exports\KbliPerusahaanExport;
use App\Http\Requests\ImportKbliPerusahaanRequest;
use App\Http\Requests\StoreKbliPerusahaanRequest;
use App\Http\Requests\UpdateKbliPerusahaanRequest;
use App\Imports\KbliPerusahaanImport;
use App\Models\AssignApprove;
use App\Models\Gambar;
use App\Models\GambarKbliPerusahaan;
use App\Models\Kabupaten;
use App\Models\Kbli;
use App\Models\KbliPerusahaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\PenanamanModal;
use App\Models\Perusahaan;
use App\Models\ProfilePengusaha;
use App\Models\UraianJenisPerusahaan;
use App\Models\UraianResikoProyek;
use App\Models\UraianSkalaUsaha;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KbliPerusahaanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kbli-perusahaan.index')->only('index');
        $this->middleware('permission:kbli-perusahaan.create')->only('create', 'store');
        $this->middleware('permission:kbli-perusahaan.edit')->only('edit', 'update');
        $this->middleware('permission:kbli-perusahaan.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $nama_perusahaan = $request->input('nama_perusahaan');
        $nama_pengusaha = $request->input('nama_pengusaha');
        $alamat = $request->input('alamat');
        $kblis = Kbli::all();
        $kecamatans = Kecamatan::all();
        $kelurahans = Kelurahan::all();
        $gambar = Gambar::all();
        $kbliperusahaans = DB::table('kbli_perusahaan')
            ->select(
                'kbli_perusahaan.id as kbliperusahaan_Id',
                'kbli_perusahaan.kode_proyek as kode_proyek',
                'kbli_perusahaan.npwp as npwp',
                'kbli_perusahaan.alamat as alamat',
                'kbli_perusahaan.longtitude',
                'kbli_perusahaan.latitude',
                'kbli_perusahaan.mesin_peralatan',
                'kbli_perusahaan.mesin_peralatan_impor',
                'kbli_perusahaan.pembelian_pematangan_tanah',
                'kbli_perusahaan.bangunan_gedung',
                'kbli_perusahaan.lain_lain',
                'kbli_perusahaan.modal_kerja',
                'kbli_perusahaan.jumlah_investasi',
                'kbli_perusahaan.tenaga_kerja',
                'perusahaan.nama_perusahaan as nama_perusahaan',
                'perusahaan.nib as nib',
                'perusahaan.no_telp as no_telp',
                'kab.nama_kabupaten',
                'kecamatan.nama_kecamatan as nama_kecamatan ',
                'kelurahan.nama_kelurahan as nama_kelurahan ',
                'kbli_perusahaan.kbli_id',
                'kbli.kbli as kbli',
                'kbli.judul_kbli as judul_kbli',
                'kbli.sektor as sektor',
                'ujp.nama_uraian_jenis_perusahaan as nama_uraian_jenis_perusahaan',
                'uraian_resiko_proyek.nama_uraian_resiko_proyek as nama_uraian_resiko_proyek',
                'uraian_skala_usaha.nama_uraian_skala_usaha as nama_uraian_skala_usaha',
                'pm.status_pmdn as status_pmdn',
                'kbli_perusahaan.profile_pengusaha_id as nama_penguasaha ',
                'kecamatan.nama_kecamatan',
                'profile_pengusaha.nama_pengusaha',
                'kelurahan.nama_kelurahan',
                'gambar.path as gambar',
            )
            ->leftJoin('perusahaan', 'kbli_perusahaan.perusahaan_id', '=', 'perusahaan.id')
            ->leftJoin('kbli', 'kbli_perusahaan.kbli_id', '=', 'kbli.id')
            ->leftJoin('profile_pengusaha', 'kbli_perusahaan.profile_pengusaha_id', '=', 'profile_pengusaha.id')
            ->leftJoin('kabupaten as kab', function ($join) {
                $join->on('perusahaan.kabupaten_id', '=', 'kab.id');
            })
            ->leftJoin('uraian_jenis_perusahaan as ujp', function ($join) {
                $join->on('perusahaan.uraian_jenis_perusahaan_id', '=', 'ujp.id');
            })
            ->leftJoin('gambar_kbli_perusahaan', 'kbli_perusahaan.id', '=', 'gambar_kbli_perusahaan.kbli_perusahaan_id')
            ->leftJoin('gambar', 'gambar_kbli_perusahaan.gambar_id', '=', 'gambar.id')

            ->leftJoin('penanaman_modal as pm', function ($join) {
                $join->on('perusahaan.penanaman_modal_id', '=', 'pm.id');
            })
            ->leftJoin('kecamatan', 'kbli_perusahaan.kecamatan_id', '=', 'kecamatan.id')
            ->leftJoin('kelurahan', 'kbli_perusahaan.kelurahan_id', '=', 'kelurahan.id')
            ->leftJoin('uraian_resiko_proyek', 'uraian_resiko_proyek_id', '=', 'uraian_resiko_proyek.id')
            ->leftJoin('uraian_skala_usaha', 'uraian_skala_usaha_id', '=', 'uraian_skala_usaha.id')

            ->when($request->input('nama_perusahaan'), function ($query, $nama_perusahaan) {
                return $query->where('nama_perusahaan', 'like', '%' . $nama_perusahaan . '%');
            })
            ->when($request->input('nama_pengusaha'), function ($query, $nama_pengusaha) {
                return $query->where('nama_pengusaha', 'like', '%' . $nama_pengusaha . '%');
            })
            ->when($request->input('alamat'), function ($query, $alamat) {
                return $query->where('kbli_perusahaan.alamat', 'like', '%' . $alamat . '%');
            })
            ->when($request->input('kecamatan'), function ($query, $kecamatan) {
                return $query->whereIn('kbli_perusahaan.kecamatan_id', $kecamatan);
            })
            ->when($request->input('kelurahan'), function ($query, $kelurahan) {
                return $query->whereIn('kbli_perusahaan.kelurahan_id', $kelurahan);
            })
            ->when($request->input('kbli'), function ($query, $kbli) {
                return $query->whereIn('kbli_perusahaan.kbli_id', $kbli);
            })
            ->where('kbli_perusahaan.data_terhapus', '=', 'false')


            ->paginate(5);
        $kecamatanSelected = $request->input('kecamatan');
        $kelurahanSelected = $request->input('kelurahan');
        $kbliSelected = $request->input('kbli');
        $kbliperusahaansCount = $kbliperusahaans->total();

        return view('data-table.kbli-perusahaan.index')->with([
            'nama_perusahaan' => $nama_perusahaan,
            'nama_pengusaha' => $nama_pengusaha,
            'kecamatans' => $kecamatans,
            'kelurahans' => $kelurahans,
            'kbliperusahaans' => $kbliperusahaans,
            'kblis' => $kblis,
            'kbliperusahaanCount' => $kbliperusahaansCount,
            'nama_perusahaan' => $nama_perusahaan,
            'nama_pengusaha' => $nama_pengusaha,
            'alamat' => $alamat,
            'kecamatanSelected' => $kecamatanSelected,
            'kelurahanSelected' => $kelurahanSelected,
            'kbliSelected' => $kbliSelected,
            'gambar' => $gambar,
        ]);
    }


    public function create(Request $request)
    {

        $kblis = Kbli::all();
        $kecamatans = Kecamatan::all();
        $kelurahans = Kelurahan::all();
        $perusahaans = Perusahaan::all();
        $pengusahans = ProfilePengusaha::all();
        $pemodalans = PenanamanModal::all();
        $uraianresikoproyeks = UraianResikoProyek::all();
        $uraianskalausahas = UraianSkalaUsaha::all();
        $gambar = Gambar::all();
        $kbliPerusahaans = KbliPerusahaan::orderBy('id', 'desc')->get();
        if ($request->input('submit')) {
            session()->forget('selected_nama_perusahaan_id');
        } else {
            $selected_nama_perusahaan_id = session('selected_nama_perusahaan_id');
        }

        return view(
            'data-table.kbli-perusahaan.create',
            compact('perusahaans', 'kbliPerusahaans', 'selected_nama_perusahaan_id')
        )->with([
            'perusahaan' => $perusahaans,
            'kbli' => $kblis,
            'kecamatan' => $kecamatans,
            'kelurahan' => $kelurahans,
            'pengusahan' => $pengusahans,
            'pemodalan' => $pemodalans,
            'uraianresikoproyek' => $uraianresikoproyeks,
            'uraianskalausaha' => $uraianskalausahas,
            'gambar' => $gambar,

        ]);
    }

    public function store(StoreKbliPerusahaanRequest $request)
    {
        $validatedData = $request->validated();
        $user = Auth::user();
        $kbliPerusahaan = KbliPerusahaan::create([
            'perusahaan_id' => $request->perusahaan_id,
            'kbli_id' => $request->kbli_id,
            'judul_kbli_id' => $request->judul_kbli_id,
            'sektor_id' => $request->sektor_id,
            'longtitude' => $request->longtitude,
            'npwp' => $request->npwp,
            'latitude' => $request->latitude,
            'kode_proyek' => $request->kode_proyek,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
            'profile_pengusaha_id' => $request->profile_pengusaha_id,
            'uraian_resiko_proyek_id' => $request->uraian_resiko_proyek_id,
            'uraian_skala_usaha_id' => $request->uraian_skala_usaha_id,
            'mesin_peralatan'  => $request->mesin_peralatan,
            'mesin_peralatan_impor'  => $request->mesin_peralatan_impor,
            'pembelian_pematangan_tanah' => $request->pembelian_pematangan_tanah,
            'bangunan_gedung'  => $request->bangunan_gedung,
            'lain_lain'  => $request->lain_lain,
            'modal_kerja'  => $request->modal_kerja,
            'jumlah_investasi'  => $request->jumlah_investasi,
            'tenaga_kerja'  => $request->tenaga_kerja,
            'updated_by' => $user->id,
            'created_by' => $user->id,
        ]);
        $gambarInput = ['gambar_utama' => 1, 'gambar_sampingan' => 0];
        foreach ($gambarInput as $inputName => $star) {
            if ($request->hasFile($inputName)) {
                $gambar = $request->file($inputName);
                $ori_name = $gambar->getClientOriginalName();
                $nama_gambar = $ori_name . '_' . time() . '.' . $gambar->getClientOriginalExtension();
                $gambar->storeAs('', $nama_gambar, 'kbli_perusahaan');
         $path = str_replace('https://pusbakor.pacitankab.go.id/storage', '', Storage::disk('kbli_perusahaan')->url($nama_gambar));


                $gambar = Gambar::create([
                    'path' => $path,
                    'nama_gambar' => $nama_gambar,
                    'star' => $star,
                ]);

                $kbliPerusahaan->gambar()->attach($gambar->id);
            }
        }

        return redirect()->route('kbli-perusahaan.index')->with('success', 'Tambah Data Kbli Perusahaan Sukses');
    }


    public function show(KbliPerusahaan $kbliPerusahaan)
    {
    }


    public function edit(KbliPerusahaan $kbli_perusahaan)
    {
        $kblis = Kbli::all();
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $kelurahans = Kelurahan::all();
        $perusahaans = Perusahaan::all();
        $pengusahans = ProfilePengusaha::all();
        $penanaman_modal_id = PenanamanModal::all();
        $uraianjenisperusahaans = UraianJenisPerusahaan::all();
        $uraianresikoproyeks = UraianResikoProyek::all();
        $uraianskalausaha = UraianSkalaUsaha::all();
        $gambar = Gambar::all();


        return view('data-table.kbli-perusahaan.edit')
            ->with([
                'kbli_perusahaan' => $kbli_perusahaan,
                'kblis' => $kblis,
                'perusahaans' => $perusahaans,
                'kabupatens' => $kabupatens,
                'kecamatans' => $kecamatans,
                'kelurahans' => $kelurahans,
                'pengusahans' => $pengusahans,
                'penanaman_modal_id' => $penanaman_modal_id,
                'uraianjenisperusahaans' => $uraianjenisperusahaans,
                'uraianresikoproyeks' => $uraianresikoproyeks,
                'uraianskalausaha' => $uraianskalausaha,
                '$gambar' => $gambar,

            ]);
    }

    public function update(UpdateKbliPerusahaanRequest $request, KbliPerusahaan $kbliPerusahaan)
    {

        // dd($request);
        $validatedData = $request->validated();
        $kbliPerusahaan->update($validatedData);
        $validate['updated_at'] = now();
        $validate['updated_by'] = auth()->user()->id;

        $kbliPerusahaan->fill($validate);
        $kbliPerusahaan->save();
        $gambarInput = ['gambar_utama' => 1, 'gambar_sampingan' => 0];
        foreach ($gambarInput as $inputName => $star) {
            if ($request->hasFile($inputName)) {

                $oldGambar = $kbliPerusahaan->gambar()->where('star', $star)->first();
                if ($oldGambar) {

                    Storage::delete('public/assets/img/' . $oldGambar->nama_gambar);
                    $oldGambar->delete();
                }


                $gambar = $request->file($inputName);
                $ori_name = $gambar->getClientOriginalName();
                $nama_gambar = $ori_name . '_' . time() . '.' . $gambar->getClientOriginalExtension();
                $gambar->storeAs('', $nama_gambar, 'kbli_perusahaan');
                $path = str_replace('https://pusbakor.pacitankab.go.id/storage', '', Storage::disk('kbli_perusahaan')->url($nama_gambar));

                $gambar = Gambar::create([
                    'path' => $path,
                    'nama_gambar' => $nama_gambar,
                    'star' => $star,
                ]);

                $kbliPerusahaan->gambar()->attach($gambar->id);
            }
        }

        // dd($kbli_perusahaan);
        return redirect()->route('kbli-perusahaan.index')
            ->with('success', 'Edit Data Kbli Perusahaan Sukses');
    }


    public function destroy(KbliPerusahaan $kbliPerusahaan)
    {
        try {
            $isUsedInOtherColumn = $this->checkIfUsedInOtherColumn($kbliPerusahaan->id);

            if ($isUsedInOtherColumn) {
                return redirect()->route('kbli-perusahaan.index')->with('error', 'Tidak Dapat Menghapus Kbli Perusahaan Yang Masih Digunakan Oleh Kolom Lain');
            }

            $kbliPerusahaan->data_terhapus = true;
            $kbliPerusahaan->delete_by = Auth::user()->id;
            $kbliPerusahaan->deleted_at = now();
            $kbliPerusahaan->save();

            return redirect()->route('kbli-perusahaan.index')->with('success', 'Hapus Data Kbli Perusahaan Sukses');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kbli-perusahaan.index')->with('success', 'Hapus Data Kbli Perusahaan Sukses');
        }
    }

    private function checkIfUsedInOtherColumn($id)
    {
        // Cek apakah 'KbliPerusahaan' dengan 'id' yang diberikan masih digunakan pada 'assignApprove'
        $isUsedInAssignApprove = AssignApprove::where('kbli_perusahaan_id', $id)->exists();

        // Jika masih digunakan pada 'assignApprove', kembalikan true untuk membatasi penghapusan
        if ($isUsedInAssignApprove) {
            return true;
        }

        // Jika tidak digunakan pada 'assignApprove', kembalikan false untuk memungkinkan penghapusan
        return false;
    }



    public function import(ImportKbliPerusahaanRequest $request)
    {
        $filePath = $request->file('import-file')->store('import-files');
        ImportKbliPerusahaanJob::dispatch(storage_path('app/' . $filePath));
        return redirect()->route('kbli-perusahaan.index')->with('success', 'Tambah Data Kbli Perusahaan Sukses diimport');
    }

    public function export()
    {
        return Excel::download(new KbliPerusahaanExport, 'Kbli Perusahaan.xlsx');
    }
    public function kbliFilter(Request $request)
    {
        $kblis['Kbli'] = Kbli::all()->where('id', $request->id);
        return response()->json($kblis);
    }

    public function editFilter(Request $request)
    {
        $kblis['Kbli'] = Kbli::all()->where('id', $request->id);
        $kbli['Kblis'] = Kbli::all()->where('id', $request->id);
        return response()->json([$kblis, $kbli]);
    }

    public function setSelectedKbliId(Request $request)
    {
        session()->put('selected_kbli_id', $request->kbli_id);
        return response()->json(['success' => true]);
    }

    public function clearSelectedKbliId()
    {
        session()->forget('selected_kbli_id');
        return response()->json(['success' => true]);
    }

    public function kelurahanFilter(Request $request)
    {
        $kelurahan['Kelurahan'] = Kelurahan::whereIn('kecamatan_id', $request->kecamatan_id)->get();
        return response()->json($kelurahan);
    }


    public function kelurahanStoreFilter(Request $request)
    {
        $kelurahan['Kelurahan'] = Kelurahan::where('kecamatan_id', $request->kecamatan_id)->get();
        return response()->json($kelurahan);
    }

    public function editLoadKelurahan(Request $request)
    {
        $kelurahan['Kelurahan'] = Kelurahan::all()->where('kecamatan_id', $request->kecamatan_id);
        return response()->json($kelurahan);
    }


    public function submitForm(StoreKbliPerusahaanRequest $request)
    {
        $request->validated();
        return response()->json(['success' => 'Added new records.']);
    }
}
