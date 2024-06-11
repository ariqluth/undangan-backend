<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTotalPembiayaanRequest extends FormRequest
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
                'string',
                Rule::unique('total_pembiayaans')->where(function ($query) {
                    return $query->where('kbli_id', $this->kbli_id)->where('id', '<>', $this->route('total_pembiayaan')->id);
                })
            ],
            'kbli_id' => 'required|string',
            'mesin_peralatan' => 'required|string|regex:/^[0-9]*$/',
            'mesin_peralatan_impor' => 'required|string|regex:/^[0-9]*$/',
            'pembelian_pematangan_tanah' => 'required|string|regex:/^[0-9]*$/',
            'bangunan_gedung' => 'required|string|regex:/^[0-9]*$/',
            'modal_kerja' => 'required|string|regex:/^[0-9]*$/',
            'lain_lain' => 'required|string|regex:/^[0-9]*$/',
            'jumlah_investasi' => 'required|string|regex:/^[0-9]*$/|min:3',
            'tenaga_kerja' => 'required|string|regex:/^[0-9]*$/|max:1000',
        ];
    }

    public function message()
    {
        return [
            'perusahaan_id.required' => 'Nama Perusahaan Wajib Diisi',
            'perusahaan_id.string' => 'Nama Perusahaan Wajib Diisi',
            'kbli_id.string' => 'Nama Kbli Wajib Diisi',
            'kbli_id.required' => 'Nama Kbli Wajib Diisi',
            'mesin_peralatan.required' => 'Nama Mesin Peralatan Wajib Diisi',
            'mesin_peralatan.regex' => 'mesin peralatan Wajib Angka',
            'mesin_peralatan_impor.required' => 'Nama Mesin Peralatan Impor Wajib Diisi',
            'pembelian_pematangan_tanah.regex' => 'pembelian pematangan tanah Wajib Angka',
            'pembelian_pematangan_tanah.required' => 'Nama Pembelian Pematangan Tanah Wajib Diisi',
            'bangunan_gedung.regex' => 'bangunan gedung Wajib Angka',
            'bangunan_gedung.required' => 'Nama Bangunan Gedung Wajib Diisi',
            'modal_kerja.required' => 'Nama Modal Kerja Wajib Diisi',
            'modal_kerja.regex' => 'modal kerja Wajib Angka',
            'lain_lain.required' => 'Nama Lain-Lain Wajib Diisi',
            'lain_lain.regex' => 'lain lain Wajib Angka',
            'jumlah_investasi.required' => 'Nama Jumlah Investasi Wajib Diisi',
            'jumlah_investasi.regex' => 'jumlah investasi Wajib Angka',
            'jumlah_investasi.min' => 'jumlah investasi min 3',
            'tenaga_kerja.required' => 'Nama Tenaga Kerja Wajib Diisi',
            'tenaga_kerja.regex' => 'tenaga kerja Wajib Angka',
            'tenaga_kerja.max' => 'tenaga kerja max 1000',
        ];

    }
}
