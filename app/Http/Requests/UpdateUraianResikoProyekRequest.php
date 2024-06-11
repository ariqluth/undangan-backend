<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUraianResikoProyekRequest extends FormRequest
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
            'nama_uraian_resiko_proyek' =>
            'string|required|regex:/^[a-zA-Z\s]+$/u|min:3|unique:uraian_resiko_proyek,nama_uraian_resiko_proyek,' . $this->uraian_resiko_proyek->id
        ];
    }

    public function messages()
    {
        return [
            'nama_uraian_resiko_proyek.string' => 'Nama Uraian Resiko Proyek Wajib Diisi',
            'nama_uraian_resiko_proyek.required' => 'Nama Uraian Resiko Proyek Wajib Diisi',
            'nama_uraian_resiko_proyek.unique' => 'Nama Uraian Resiko Proyek Telah Ada',
            'nama_uraian_resiko_proyek.regex' => 'Nama Uraian Resiko Proyek Tidak Boleh Angka',
            'nama_uraian_resiko_proyek.min' => 'Nama Uraian Resiko Proyek Kurang Dari Yang Ditentukan',
        ];
    }
}
