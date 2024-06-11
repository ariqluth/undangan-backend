<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKbliPerusahaanRequest extends FormRequest
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
            'perusahaan_id' => [
                'required',
                Rule::unique('kbli_perusahaan')
                    ->where('kbli_id', $this->kbli_id)
            ],
            'kbli_id' => 'required',
            'kecamatan_id' => 'required|string',
            'kelurahan_id' => 'required|string',
            'uraian_resiko_proyek_id' => 'required|string',
            'profile_pengusaha_id' => 'required|string',
            'uraian_skala_usaha_id' => 'required|string',
            'alamat' => 'required|string',
            'npwp' => 'required|string|regex:/^[0-9]*$/',
            'kode_proyek' => 'required|string|min:3|max:60',
            'longtitude' => 'required|string|min:3',
            'latitude' => 'required|string|min:3',
            'mesin_peralatan' => 'required|string|regex:/^[0-9]*$/',
            'mesin_peralatan_impor' => 'required|string|regex:/^[0-9]*$/',
            'pembelian_pematangan_tanah' => 'required|string|regex:/^[0-9]*$/',
            'bangunan_gedung' => 'required|string|regex:/^[0-9]*$/',
            'modal_kerja' => 'required|string|regex:/^[0-9]*$/',
            'lain_lain' => 'required|string|regex:/^[0-9]*$/',
            'jumlah_investasi' => 'required|string|regex:/^[0-9]*$/',
            'tenaga_kerja' => 'required|string|regex:/^[0-9]*$/',
            'gambar' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'perusahaan_id.required' => 'Nama Perusahaan Wajib Diisi',
            'perusahaan_id.unique' => 'Nama Perusahaan Telah Ada Dengan Usaha Ini',
            'kbli_id.required' => 'Kbli Wajib Diisi',
            'kecamatan_id.required' => 'Kecamatan Wajib Disi',
            'kelurahan_id.required' => 'Kelurahan Wajib Disi',
            'uraian_resiko_proyek_id.required' => 'uraian resiko proyek Wajib Disi',
            'profile_pengusaha_id.required' => 'Nama Pengusaha Wajib Disi',
            'uraian_skala_usaha_id.required' => 'uraian skala usaha Wajib Disi',
            'alamat.required' => 'alamat Wajib Disi',
            'npwp.required' => 'npwp Wajib Disi',
            'npwp.regex' => 'npwp Wajib Angka',
            'kode_proyek.required' => 'no proyek Wajib Disi',
            'longtitude.required' => 'longtitude Wajib Disi',
            'latitude.required' => 'latitude Wajib Disi',
            'kode_proyek.min' => 'no proyek minimal 3 huruf',
            'kode_proyek.max' => 'no proyek minimal 60 huruf',
            'mesin_peralatan.required' => 'mesin peralatan Wajib Disi',
            'mesin_peralatan.regex' => 'mesin peralatan Wajib angka',
            'mesin_peralatan_impor.required' => 'mesin peralatan impor Wajib Disi',
            'mesin_peralatan_impor.regex' => 'mesin peralatan impor Wajib angka',
            'pembelian_pematangan_tanah.required' => 'pembelian pematangan tanah Wajib Disi',
            'pembelian_pematangan_tanah.regex' => 'pembelian pematangan tanah Wajib angka',
            'bangunan_gedung.required' => 'bangunan gedung Wajib Disi',
            'bangunan_gedung.regex' => 'bangunan gedung Wajib angka',
            'modal_kerja.required' => 'modal kerja Wajib Disi',
            'modal_kerja.regex' => 'modal kerja Wajib angka',
            'lain_lain.required' => 'lain - lain Wajib Disi',
            'lain_lain.regex' => 'lain - lain Wajib angka',
            'jumlah_investasi.required' => 'jumlah investasi Wajib Disi',
            'jumlah_investasi.regex' => 'jumlah investasi Wajib angka',
            'tenaga_kerja.required' => 'tenga kerja Wajib Disi',
            'tenaga_kerja.regex' => 'tenaga kerja Wajib angka',
            'gambar.image' => 'wajib format jpeg, png, jpg',
            'gambar.max' => 'ukuran file max 5 mb',
        ];
    }
}
