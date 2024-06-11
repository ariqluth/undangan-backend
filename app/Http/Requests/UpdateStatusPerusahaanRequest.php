<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStatusPerusahaanRequest extends FormRequest
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
            'perusahaan_id' => 'required|string',
            'pmdn' => 'required|string',
            'kbli_id' => ['required',Rule::unique('status_perusahaans')->where('kbli_id',$this->kbli_id)->ignore($this->status_perusahaan->id)],
            'uraian_jenis_perusahaan_id' => 'required|string',
            'uraian_resiko_proyek_id' => 'required|string',
            'uraian_skala_usaha_id' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'perusahaan_id.required' => 'Nama Perusahaan Wajib Diisi',
            'pmdn.required' => 'Nama PMDN Wajib Diisi',
            'kbli_id.required' => 'KBLI Wajib Diisi',
            'kbli_id.unique' => 'KBLI Sudah Ada',
            'uraian_jenis_perusahaa_id.required' => 'Nama Uraian Jenis Perusahaan Wajib Diisi',
            'uraian_resiko_proyek_id.required' => 'Nama Uraian Resiko Proyek Wajib Diisi',
            'uraian_skala_usaha_id.required' => 'Nama Uraian Skala Usaha Wajib Diisi',
        ];
    }
}
