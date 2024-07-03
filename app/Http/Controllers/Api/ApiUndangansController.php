<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderList;
use App\Models\Orders;
use App\Models\Undangans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Symfony\Component\HttpFoundation\Response;

class ApiUndangansController extends Controller
{
    public function index()
    {
        $undangans = Undangans::all();
        return response()->json($undangans);
    }

    public function store(Request $request)
    {
        try {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'order_list_id' => 'required',
            'nama_pengantin_pria' => 'required|string',
            'nama_pengantin_wanita' => 'required|string',
            'tanggal_pernikahan' => 'required|string',
            'lokasi_pernikahan' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
          
        ]);

        $undangan = Undangans::create($validatedData);
        Log::info('Undangan created', ['undangan' => $undangan]);
    
         $Orderexists = Orders::find($validatedData['order_id']);
         if (!$Orderexists) {
             return response()->json(['error' => 'Order not found'], 404);
         }

         $Orderlistexists = OrderList::find($validatedData['order_list_id']);
         if (!$Orderlistexists) {
             return response()->json(['error' => 'Order list not found'], 404);
         }
 
         return response()->json(
            [
                "success" => true,
                'message' => 'undangan berhasil disimpan',
                'data' => $undangan
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
        Log::error('Error creating undangan', ['error' => $e->getMessage()]);
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
        $undangans = Undangans::findOrFail($id);
        return response()->json($undangans);
    }

 
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'order_list_id' => 'required|string',
            'nama_pengantin_pria' => 'required|string',
            'nama_pengantin_wanita' => 'required|string',
            'tanggal_pernikahan' => 'required|string',
            'lokasi_pernikahan' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string'
        ]);

        $undangans = Undangans::findOrFail($id);
        $undangans->update($validatedData);
        return response()->json($undangans);
    }

   
    public function destroy($id)
    {
        $undangans = Undangans::findOrFail($id);
        $undangans->delete();
        return response()->json(null, 204);
    }

    public function getUndanganByPetugas($order_list_id)
    {
        try {
            $undangans = Undangans::where('order_list_id', $order_list_id)->get();
    
            if ($undangans->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data masih kosong, silakan menambahkan undangan'
                ], 200); 
            }
    
            return response()->json([
                'success' => true,
                'data' => $undangans
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to retrieve undangans',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    

    public function createUndanganByPetugas(Request $request, $order_list_id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|integer',
            'nama_pengantin_pria' => 'required|string',
            'nama_pengantin_wanita' => 'required|string',
            'tanggal_pernikahan' => 'required|date',
            'lokasi_pernikahan' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
        ]);

        
        $validatedData['order_list_id'] = $order_list_id;

        try {
            
            $undangan = Undangans::create($validatedData);

            
            return response()->json([
                'message' => 'Undangan created successfully',
                'data' => $undangan
            ], 201);
        } catch (\Exception $e) {
            
            return response()->json([
                'error' => 'Failed to create undangan',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
