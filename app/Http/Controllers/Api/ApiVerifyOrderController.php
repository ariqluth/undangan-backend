<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Profiles;
use App\Models\VerifyOrder;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ApiVerifyOrderController extends Controller
{
    public function index()
    {
        try {
            $verifyorder = VerifyOrder::with('order', 'profile')
                ->get()
                ->map(function ($verifyorder) {
                    return [
                        'id' => $verifyorder->id,
                        'nama_pelanggan' => $verifyorder->order->profile->username,
                        'item_id' => $verifyorder->order->item_id,
                        'jumlah' => $verifyorder->order->jumlah,
                        'tanggal_terakhir' => $verifyorder->order->tanggal_terakhir,
                        'kode' => $verifyorder->order->kode,
                        'status' => $verifyorder->order->status,
                        'nama_item' => $verifyorder->order->item->nama_item,
                        'nama_petugas' => $verifyorder->profile->username,
                        'id_petugas' => $verifyorder->profile->id,
                    ];
                });

            if ($verifyorder->isEmpty()) {
                return response()->json(['error' => 'No orders found for this profile'], 404);
            }
            return response()->json($verifyorder, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve orders', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|integer',
            'profile_id' => 'required|integer',
        ]);

        // Check if the profile_id exists in the profiles table
        $profileExists = Profiles::find($validatedData['profile_id']);
        if (!$profileExists) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        try {
            $verifyOrder = VerifyOrder::create($validatedData);
            return response()->json($verifyOrder, 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to create verify order', 'message' => $e->getMessage()], 500);
        }
    }
 
    public function show($id)
    {
        $undangans = VerifyOrder::findOrFail($id);
        return response()->json($undangans);
    }

 
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'profile_id' => 'required|string',
        ]);

        $undangans = VerifyOrder::findOrFail($id);
        $undangans->update($validatedData);
        return response()->json($undangans);
    }

   
    public function destroy($id)
    {
        $undangans = VerifyOrder::findOrFail($id);
        $undangans->delete();
        return response()->json(null, 204);
    }

    public function getOrdersByPetugas($id_petugas)
    {
        try {
            $verifyOrders = VerifyOrder::with('order', 'profile')
                ->where('profile_id', $id_petugas)
                ->get()
                ->map(function ($verifyOrder) {
                    return [
                        'id' => $verifyOrder->id,
                        'nama_pelanggan' => $verifyOrder->order->profile->username,
                        'item_id' => $verifyOrder->order->item_id,
                        'order_id' => $verifyOrder->order->id,
                        'jumlah' => $verifyOrder->order->jumlah,
                        'tanggal_terakhir' => $verifyOrder->order->tanggal_terakhir,
                        'kode' => $verifyOrder->order->kode,
                        'status' => $verifyOrder->order->status,
                        'nama_item' => $verifyOrder->order->item->nama_item,
                        'nama_petugas' => $verifyOrder->profile->username,
                        'id_petugas' => $verifyOrder->profile->id,
                    ];
                });

            if ($verifyOrders->isEmpty()) {
                return response()->json(['error' => 'No orders found for this petugas'], 404);
            }
            return response()->json($verifyOrders, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve orders', 'message' => $e->getMessage()], 500);
        }
    }
}
