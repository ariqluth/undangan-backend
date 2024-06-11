<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKbliRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'kbli' => 'string|required|unique:kbli|min:3|max:10',
            'judul_kbli' => 'string|required|regex:/^[a-zA-Z\s]+$/u|unique:kbli|min:3|max:50',
            'sektor' => 'string|required|regex:/^[a-zA-Z\s]+$/u|unique:kbli|min:3|max:50',

        ];
    }

    public function messages()
    {
        return [
            'judul_kbli.string' => 'Judul Kbli Wajib Diisi',
            'judul_kbli.required' => 'Judul Kbli Wajib Diisi',
            'judul_kbli.unique' => 'Judul Kbli Telah Ada',
            'judul_kbli.regex' => 'Judul Kbli Tidak Boleh Karakter',
            'judul_kbli.min' => 'Judul Kbli Kurang Dari 3 Karakter',
            'judul_kbli.max' => 'Judul Kbli Melebihi Dari 50 Karakter',
            'kbli.required' => 'KBLI Wajib Diisi',
            'kbli.required' => 'KBLI Wajib Diisi',
            'kbli.unique' => 'KBLI telah ada',
            'kbli.min' => 'KBLI Kurang Dari 3 Karakter',
            'kbli.max' => 'KBLI Melebihi Dari 10 Karakter',
            'sektor.string' => 'Sektor Wajib Diisi',
            'sektor.required' => 'Sektor Wajib Diisi',
            'sektor.unique' => 'Sektor Telah Ada',
            'sektor.regex' => 'Sektor Tidak Boleh Karakter',
            'sektor.min' => 'Sektor Kurang Dari 3 Karakter',
            'sektor.max' => 'Sektor Melebihi Dari 50 Karakter',
        ];
    }
}
