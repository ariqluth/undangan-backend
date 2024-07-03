<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderList;
use App\Models\Orders;
use App\Models\VerifyOrder;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class ApiOrderListController extends Controller
{
    public function index()
    {
        try {
            $orderlist = OrderList::with('order.profile', 'order.item', 'verifyorder.profile')
                ->get()
                ->map(function ($orderlist) {
                    return [
                        'id' => $orderlist->id,
                        'nama_pelanggan' => optional($orderlist->order->profile)->username,
                        'item_id' => optional($orderlist->order)->item_id,
                        'jumlah' => optional($orderlist->order)->jumlah,
                        'tanggal_terakhir' => optional($orderlist->order)->tanggal_terakhir,
                        'status' => optional($orderlist->order)->status,
                        'nama_item' => optional($orderlist->order->item)->nama_item,
                        'nama_petugas' => optional($orderlist->verifyorder->profile)->username,
                        'type_undangan' => $orderlist->type,
                        'kode_undangan' => $orderlist->kode,
                        'id_petugas' => optional($orderlist->verifyorder->profile)->id,
                    ];
                });

            if ($orderlist->isEmpty()) {
                return response()->json(['error' => 'No orders found for this profile'], 404);
            }
            return response()->json($orderlist, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve orders', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'order_id' => 'required|integer',
                'verify_order_id' => 'required|integer',
                'type' => 'required|string',
                'kode' => 'required|string',
            ]);

            // Check if the verify_order_id exists in the verify_orders table
            $verifyOrderExists = VerifyOrder::find($validatedData['verify_order_id']);
            if (!$verifyOrderExists) {
                return response()->json(['error' => 'Verify order not found'], 404);
            }

            $orderList = OrderList::create($validatedData);
            return response()->json($orderList, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'messages' => $e->errors()], 422);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to create order list', 'message' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $orderlist = OrderList::findOrFail($id);
            return response()->json($orderlist, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Order list not found', 'message' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'order_id' => 'required|integer',
                'verify_order_id' => 'required|integer',
                'type' => 'required|string',
                'kode' => 'required|string',
            ]);

            $orderlist = OrderList::findOrFail($id);
            $orderlist->update($validatedData);
            return response()->json($orderlist, 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'messages' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update order list', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $orderlist = OrderList::findOrFail($id);
            $orderlist->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete order list', 'message' => $e->getMessage()], 500);
        }
    }

    public function getByPetugas($id_petugas)
    {
        try {
            $orderlist = OrderList::whereHas('verifyorder', function ($query) use ($id_petugas) {
                $query->where('profile_id', $id_petugas);
            })
            ->with('order.profile', 'order.item', 'verifyorder.profile')
            ->get()
            ->map(function ($orderlist) {
                return [
                    'id' => $orderlist->id,
                    'nomerid' => $orderlist->id,
                    'nama_pelanggan' => optional($orderlist->order->profile)->username,
                    'item_id' => optional($orderlist->order)->item_id,
                    'jumlah' => optional($orderlist->order)->jumlah,
                    'tanggal_terakhir' => optional($orderlist->order)->tanggal_terakhir,
                    'status' => optional($orderlist->order)->status,
                    'nama_item' => optional($orderlist->order->item)->nama_item,
                    'nama_petugas' => optional($orderlist->verifyorder->profile)->username,
                    'type_undangan' => $orderlist->type,
                    'kode_undangan' => $orderlist->kode,
                    'id_petugas' => optional($orderlist->verifyorder->profile)->id,
                ];
            });

            if ($orderlist->isEmpty()) {
                return response()->json(['error' => 'No orders found for this petugas'], 404);
            }
            return response()->json($orderlist, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve orders', 'message' => $e->getMessage()], 500);
        }
    }

    public function getOrderDropdown($orderlist_id)
    {
        try {
            $orderList = OrderList::with('order.profile')->findOrFail($orderlist_id);
            $profileId = $orderList->order->profile->id;
            $orders = Orders::where('profile_id', $profileId)->with('profile')->get();
            $dropdownData = $orders->map(function ($order) {
                return [
                    'order_id' => $order->id,
                    'username' => $order->profile->username,
                    'jumlah' => $order->jumlah,
                ];
            });

            return response()->json($dropdownData, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve orders', 'message' => $e->getMessage()], 500);
        }
    }
}
