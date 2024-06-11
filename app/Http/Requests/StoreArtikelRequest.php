<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArtikelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judul' => 'string|required',
            'deskripsi'=> 'string|required',
            // 'kategori_id' => 'string|required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'slug' => 'string|required'
        ];
    }

    public function messages()
{
    return [
        'thumbnail.required' => 'gambar wajib diisikan',
        'thumbnail.image' => 'gambar wajib jpeg, png, jpg',
        'thumbnail.mimes' => 'gambar wajib jpeg, png, jpg',
        'judul.required' => 'judul wajib diisikan',
        'deskripsi.required' => 'deskripsi wajib diisikan',
        'thumbnail.max' => 'gambar max 2 mb',
        'slug.string' => 'Slug Artikel Wajib diisi',
        'slug.required' => 'Slug Artikel Wajib diisi',
    ];
}
}
