<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGambarKbliPerusahaanRequest extends FormRequest
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
            'kbli_perusahaan_id' => 'required',
            'path' => 'required',
            'gambar.*' => 'nullable|mimes:jpeg,png,jpg|max:2048', // menambahkan tanda * untuk menandakan validasi multiple gambar
            'star' => 'required',
        ];
    }

    public function message()
    {
        return [
            'kbli_perusahaan_id.required' => 'KBLI Perusahaan Wajib Diisi',
            'path.required' => 'Path Wajib Diisi',
            'gambar.*.image' => 'wajib format jpeg, png, jpg', // menambahkan tanda * untuk menandakan validasi multiple gambar
            'gambar.*.max' => 'ukuran file max 5 mb', // menambahkan tanda * untuk menandakan validasi multiple gambar
            'star.required' => 'Star Wajib Diisi'
        ];
    }
}
