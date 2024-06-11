<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKategoriArtikelRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_kategori' => 'string|required|min:3',
            'slug' => 'string|required|unique:kategori_artikel'
        ];
    }



public function messages()
{
    return [
        'nama_kategori.string' => 'Kategori Artikel Wajib diisi',
        'nama_kategori.required' => 'Kategori Artikel Wajib diisi',
        'nama_kategori.min' => 'Kategori Artikel kurang dari 3 Karakter',
        'slug.string' => 'Slug Kategori Artikel Wajib diisi',
        'slug.required' => 'Slug Kategori Artikel Wajib diisi',
        'slug.unique' => 'Slug Kategori Artikel telah ada',
    ];
}

}
