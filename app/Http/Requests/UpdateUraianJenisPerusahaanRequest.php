<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUraianJenisPerusahaanRequest extends FormRequest
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
            'nama_uraian_jenis_perusahaan' =>
            'string|required|regex:/^[a-zA-Z\s]+$/u|min:3|unique:uraian_jenis_perusahaan,nama_uraian_jenis_perusahaan,' . $this->uraian_jenis_perusahaan->id
        ];
    }

    public function messages()
    {
        return [
            'nama_uraian_jenis_perusahaan.string' => 'Nama Uraian Jenis Perusahaan Wajib Diisi',
            'nama_uraian_jenis_perusahaan.required' => 'Nama Uraian Jenis Perusahaan Wajib Diisi',
            'nama_uraian_jenis_perusahaan.unique' => 'Nama Uraian Jenis Perusahaan Telah Ada',
            'nama_uraian_jenis_perusahaan.regex' => 'Nama Uraian Jenis Perusahaan Tidak Boleh Angka',
            'nama_uraian_jenis_perusahaan.min' => 'Nama Uraian Jenis Perusahaan Kurang Dari Yang Ditentukan',
        ];
    }
}
