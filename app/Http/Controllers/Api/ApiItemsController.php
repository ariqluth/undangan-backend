<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Tambahkan ini
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ApiItemsController extends Controller
{
    public function index()
    {
          $items = Items::all()->map(function ($item) {
            $item->gambar = url('storage/' . $item->gambar); // Generate full URL
            return $item;
        });

        return response()->json($items);
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'user_id' => 'required',
                'gambar' => 'required|file|mimes:jpg,jpeg,png',
                'nama_item' => 'required|string',
            ]);

            Log::info('Validation passed', $validatedData);

            // Penyimpanan file
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = 'public/assets/img/items/' . $filename;
                Storage::disk('public')->put($filePath, file_get_contents($file));
                $validatedData['gambar'] = $filePath;
                Log::info('File stored at', ['filePath' => $filePath]);
            } else {
                Log::warning('No file found in the request');
            }

            // Pembuatan item
            $item = Items::create($validatedData);
            Log::info('Item created', ['item' => $item]);

            return response()->json(
                [
                    "success" => true,
                    'message' => 'Item berhasil disimpan',
                    'data' => $item
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
            Log::error('Error creating item', ['error' => $e->getMessage()]);
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
        $item = Items::findOrFail($id);
        if ($item->gambar) {
            $item->gambar_url = Storage::url($item->gambar);
        }
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        Log::info('Update method called'); // Log untuk debugging

        // Validasi input
        $validatedData = $request->validate([
            'user_id' => 'required',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png',
            'nama_item' => 'nullable|string',
        ]);

        Log::info('Validation passed', $validatedData); // Log untuk debugging

        // Cari item yang akan diupdate
        $item = Items::findOrFail($id);

        // Penyimpanan file baru dan penghapusan file lama
        if ($request->hasFile('gambar')) {
            if ($item->gambar && Storage::exists($item->gambar)) {
                Storage::delete($item->gambar);
                Log::info('Old file deleted', ['filePath' => $item->gambar]); // Log untuk debugging
            }

            $file = $request->file('gambar');
            $filePath = $file->store('public/assets/img/items');
            $validatedData['gambar'] = $filePath;
            Log::info('File stored at', ['filePath' => $filePath]); // Log untuk debugging
        }

        // Update item
        try {
            $item->update($validatedData);
            Log::info('Item updated', ['item' => $item]); // Log untuk debugging
            return response()->json($item);
        } catch (\Exception $e) {
            Log::error('Error updating item', ['error' => $e->getMessage()]); // Log untuk debugging
            return response()->json(['error' => 'Failed to update item'], 500);
        }
    }

    public function destroy($id)
    {
        $item = Items::findOrFail($id);
        if ($item->gambar && Storage::exists($item->gambar)) {
            Storage::delete($item->gambar);
        }
        $item->delete();
        return response()->json(null, 204);
    }
}
