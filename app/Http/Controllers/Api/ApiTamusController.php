<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tamus;
use App\Models\Undangans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Symfony\Component\HttpFoundation\Response;

class ApiTamusController extends Controller
{
    public function index()
    {
        $tamus = Tamus::all();
        return response()->json([
            "success" => true,
            'message' => 'tamu berhasil disimpan',
            'data' => $tamus
        ]);
    }

    public function store(Request $request)
    {
        try {
        $validatedData = $request->validate([
            'undangan_id' => 'required',
            'nama_tamu' => 'required|string',
            'email_tamu' => 'required|string',
            'alamat_tamu' => 'required|string',
            'nomer_tamu' => 'required|string',
            'status' => 'required|string',
            'kategori' => 'required|string',
            'kodeqr' => 'required|string',
            'tipe_undangan' => 'required|string',
        ]);

        $tamus = Tamus::create($validatedData);
        
        Log::info('Tamu created', ['tamu' => $tamus]);
    
         $undanganexists = Undangans::find($validatedData['undangan_id']);
         if (!$undanganexists) {
             return response()->json(['error' => 'Undangan not found'], 404);
         }
 
         return response()->json(
            [
                "success" => true,
                'message' => 'tamu berhasil disimpan',
                'data' => $tamus
            ],
            Response::HTTP_CREATED
        );
    } catch (ValidationException $e) {
        Log::error('Validation error', ['errors' => $e->errors()]);
        return response()->json(
            [
                "success" => false,
                'message' => 'Data validasi gagal',
                'errors' => $e->errors()
            ],
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    } catch (\Exception $e) {
        Log::error('Error creating tamu', ['error' => $e->getMessage()]);
        return response()->json(
            [
                "success" => false,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }


    }
 
    public function show($id)
    {
        try {
        $tamus = Tamus::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $tamus
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => 'Failed to show tamu',
            'message' => $e->getMessage()
        ], 500);
    }
    }

    public function updateStatus($id)
    {
        $tamu = Tamus::find($id);

        if ($tamu) {
            if ($tamu->status === 'belum datang') {
                $tamu->status = 'datang';
                $tamu->save();

                return response()->json(['message' => 'Status updated successfully', 'data' => $tamu], 200);
            } else {
                return response()->json(['message' => 'Status is not "belum datang"'], 400);
            }
        } else {
            return response()->json(['message' => 'Tamu not found'], 404);
        }
    }

    public function getTamuByPetugas($undangan_id)
    {
        try {
            $tamu = Tamus::where('undangan_id', $undangan_id)->get();
    
            if ($tamu->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data masih kosong, silakan menambahkan tamu'
                ], 200); 
            }
    
            return response()->json([
                'success' => true,
                'data' => $tamu
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to retrieve tamu',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getShareUndangan(Request $request, $undangan_id)
    {
        try {
            $undangan = Undangans::with(['tamus' => function ($query) use ($request) {
                if ($request->has('nama_tamu')) {
                    $query->where('nama_tamu', 'like', '%' . $request->input('nama_tamu') . '%');
                }
                if ($request->has('nomer_tamu')) {
                    $query->where('nomer_tamu', 'like', '%' . $request->input('nomer_tamu') . '%');
                }
            }])->findOrFail($undangan_id);

            $result = [
                'id' => $undangan->id,
                'nama_pengantin_pria' => $undangan->nama_pengantin_pria,
                'nama_pengantin_wanita' => $undangan->nama_pengantin_wanita,
                'tanggal_pernikahan' => $undangan->tanggal_pernikahan,
                'lokasi_pernikahan' => $undangan->lokasi_pernikahan,
                'longitude' => $undangan->longitude,
                'latitude' => $undangan->latitude,
                'tamus' => $undangan->tamus->map(function ($tamu) {
                    return [
                        'id' => $tamu->id,
                        'nama_tamu' => $tamu->nama_tamu,
                        'email_tamu' => $tamu->email_tamu,
                        'alamat_tamu' => $tamu->alamat_tamu,
                        'nomer_tamu' => $tamu->nomer_tamu,
                        'status' => $tamu->status,
                        'kategori' => $tamu->kategori,
                        'kodeqr' => $tamu->kodeqr,
                        'tipe_undangan' => $tamu->tipe_undangan,
                    ];
                })
            ];

            return response()->json([
                'success' => true,
                'data' => $result
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to retrieve data',
                'message' => $e->getMessage()
            ], 500);
        }
    }
 
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'undangan_id' => 'required',
            'nama_tamu' => 'required|string',
            'email_tamu' => 'required|string',
            'alamat_tamu' => 'required|string',
            'nomer_tamu' => 'required|string',
            'status' => 'required',
            'kategori' => 'required|string',
            'kodeqr' => 'required',
            'tipe_undangan' => 'required',
        ]);

        $tamus = Tamus::findOrFail($id);
        $tamus->update($validatedData);
        return response()->json($tamus);
    }

   
    public function destroy($id)
    {
        $tamus = Tamus::findOrFail($id);
        $tamus->delete();
        return response()->json(null, 204);
    }

}
