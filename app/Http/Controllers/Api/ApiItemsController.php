<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request; 

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
             'gambar' => 'required|file|mimes:jpg,jpeg,png', 
             'nama_item' => 'required|string',
         ]);
 
         if ($request->hasFile('gambar')) {
             $file = $request->file('gambar');
             $filename = time() . '_' . $file->getClientOriginalName();
             $filePath = 'assets/img/items/' . $filename;
             $file->move(public_path('assets/img/items'), $filename);
             $validatedData['gambar'] = $filePath;
         }
 
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
             'gambar' => 'nullable|file|mimes:jpg,jpeg,png',
             'nama_item' => 'nullable|string',
            
         ]);
 
         $item = Items::findOrFail($id);
         if ($request->hasFile('gambar')) {
            if ($item->gambar && file_exists(public_path($item->gambar))) {
                unlink(public_path($item->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = 'assets/img/items/' . $filename;
            $file->move(public_path('assets/img/items'), $filename);
            $validatedData['gambar'] = $filePath;
        }

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
