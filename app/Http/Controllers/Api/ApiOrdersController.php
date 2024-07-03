<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiOrdersController extends Controller
{
    public function index()
    {
        try {
            $orders = Orders::with('item')
                ->get()
                ->map(function ($order) {
                    return [
                        'id' => $order->id,
                        'profile_id' => $order->profile_id,
                        'item_id' => $order->item_id,
                        'jumlah' => $order->jumlah,
                        'tanggal_terakhir' => $order->tanggal_terakhir,
                        'kode' => $order->kode,
                        'status' => $order->status,
                        'nama_item' => $order->item->nama_item,
                    ];
                });

            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found for this profile'], 404);
            }
            return response()->json($orders, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve orders', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_id' => 'required|integer',
            'item_id' => 'required|integer',
            'jumlah' => 'required|string',
            'tanggal_terakhir' => 'required|date',
            'kode' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'messages' => $validator->errors()], 422);
        }

        try {
            $order = Orders::create($validator->validated());
            return response()->json($order, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create order', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $order = Orders::findOrFail($id);
            return response()->json($order, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Order not found', 'message' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'profile_id' => 'required|integer',
            'item_id' => 'required|integer',
            'jumlah' => 'required|string',
            'tanggal_terakhir' => 'required|date',
            'kode' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'messages' => $validator->errors()], 422);
        }

        try {
            $order = Orders::findOrFail($id);
            $order->update($validator->validated());
            return response()->json($order, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update order', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $order = Orders::findOrFail($id);
            $order->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete order', 'message' => $e->getMessage()], 500);
        }
    }

    public function showByProfileId($profile_id)
    {
        try {
            $orders = Orders::with('item')
                ->where('profile_id', $profile_id)
                ->get()
                ->map(function ($order) {
                    return [
                        'id' => $order->id,
                        'profile_id' => $order->profile_id,
                        'item_id' => $order->item_id,
                        'jumlah' => $order->jumlah,
                        'tanggal_terakhir' => $order->tanggal_terakhir,
                        'kode' => $order->kode,
                        'status' => $order->status,
                        'nama_item' => $order->item->nama_item,
                    ];
                });

            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found for this profile'], 404);
            }
            return response()->json($orders, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve orders', 'message' => $e->getMessage()], 500);
        }
    }

    
    public function broadcastOrder($id)
    {
        try {
            $order = Orders::findOrFail($id);
            $order->status = 'verify';
            $order->save();
            return response()->json(['message' => 'Order broadcasted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to broadcast order', 'message' => $e->getMessage()], 500);
        }
    }
    

    public function cancelOrder($id)
    {
        try {
            $order = Orders::findOrFail($id);
            $order->status = 'pending';
            $order->save();
            return response()->json(['message' => 'Order cancel successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to cancel order', 'message' => $e->getMessage()], 500);
        }
    }

    public function getOrderStatus()
    {
        try {
            $orders = Orders::with('item', 'profile')
                ->where('status', 'verify')
                ->get()
                ->map(function ($order) {
                    return [
                        'id' => $order->id,
                        'profile_id' => $order->profile_id,
                        'item_id' => $order->item_id,
                        'jumlah' => $order->jumlah,
                        'tanggal_terakhir' => $order->tanggal_terakhir,
                        'kode' => $order->kode,
                        'status' => $order->status,
                        'nama_item' => $order->item->nama_item,
                        'name' => $order->profile->username,
                    ];
                });

            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found with status verify'], 404);
            }
            return response()->json($orders, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve orders', 'message' => $e->getMessage()], 500);
        }
    }
}
