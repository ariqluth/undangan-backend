<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Items;

class ApiItemsController extends Controller
{

     public function index()
     {
         $items = Items::all();
         return response()->json($items);
     }
 
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'user_id' => 'required',
             'gambar' => 'nullable|string',
             'nama_item' => 'nullable|string',
     
         ]);
 
         $item = Items::create($validatedData);
         return response()->json($item, 201);
     }
 
  
     public function show($id)
     {
         $item = Items::findOrFail($id);
         return response()->json($item);
     }
 
  
     public function update(Request $request, $id)
     {
         $validatedData = $request->validate([
             'user_id' => 'required',
             'gambar' => 'nullable|string',
             'nama_item' => 'nullable|string',
            
         ]);
 
         $item = Items::findOrFail($id);
         $item->update($validatedData);
         return response()->json($item);
     }
 
    
     public function destroy($id)
     {
         $item = Items::findOrFail($id);
         $item->delete();
         return response()->json(null, 204);
     }
}
