<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssignApproveRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kbli_perusahaan_id' => 'required',
            'assign_to' => 'required',
            'perusahaan_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'kbli_perusahaan_id.required' => 'Jenis Usaha Wajib Diisi',
            'assign_to.required' => 'Pilihan Petugas Wajib Diisi',
            'perusahaan_id.required' => 'Pilihan Perusahaan Wajib Diisi',
        ];
    }
}
