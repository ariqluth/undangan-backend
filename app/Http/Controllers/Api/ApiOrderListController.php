<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderList;
use Illuminate\Http\Request;


class ApiOrderListController extends Controller
{

    public function index()
    {
        $orderlist = OrderList::all();
        return response()->json($orderlist);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'verify_order' => 'required|string',
            'type' => 'required|string',
            'kode' => 'required|string',
        ]);

        $orderlist = OrderList::create($validatedData);
        return response()->json($orderlist, 201);
    }

 
    public function show($id)
    {
        $orderlist = OrderList::findOrFail($id);
        return response()->json($orderlist);
    }

 
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'verify_order' => 'required|string',
            'type' => 'required|string',
            'kode' => 'required|string',
        ]);

        $orderlist = OrderList::findOrFail($id);
        $orderlist->update($validatedData);
        return response()->json($orderlist);
    }

   
    public function destroy($id)
    {
        $orderlist = OrderList::findOrFail($id);
        $orderlist->delete();
        return response()->json(null, 204);
    }
}
