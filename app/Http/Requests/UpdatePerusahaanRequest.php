<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePerusahaanRequest extends FormRequest
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

    public function rules()
    {
        return [
            'nama_perusahaan' => 'required|string|regex:/^[a-zA-Z\s]+$/u|unique:perusahaan,nama_perusahaan,' . $this->perusahaan->id,
            'nib' => 'required|string|regex:/^[0-9]*$/|unique:perusahaan,nib,' . $this->perusahaan->id,
            'penanaman_modal_id' => 'required|string',
            'uraian_jenis_perusahaan_id' => 'required|string',
            'alamat' => 'required|string|max:250',
            'kabupaten_id' => 'required|string',
            'email' => 'nullable|email',
            'no_telp' => 'nullable|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,8}$/',

        ];
    }

    public function messages()
    {
        return [
            'nama_perusahaan.required' => 'Nama Perusahaan Wajib Diisi',
            'nama_perusahaan.unique' => 'Nama Perusahaan Telah Ada',
            'nama_perusahaan.regex' => 'Nama Perusahaan Tidak Boleh Karakter',
            'nib.required' => 'NIB Wajib Diisi',
            'nib.regex' => 'NIB Wajib Angka',
            'nib.unique' => 'NIB Telah Ada',
            'penanaman_modal_id.required' => 'Status Penanaman Modal Wajib Diisi',
            'uraian_jenis_perusahaan_id.required' => 'Uraian Jenis Perusahaan Wajib Diisi',
            'alamat.required' => 'Alamat Usaha Wajib Diisi',
            'alamat.max' => 'Alamat Usaha Melebihi Dari Ketentuan',
            'kabupaten_id.required' => 'Nama Kabupaten Wajib Diisi',
            'no_telp.regex' => 'Nomor Telpon Tidak Sesuai Ketentuan',
            'email.email' => 'Email Tidak Sesuai Ketentuan',
        ];
    }
}
