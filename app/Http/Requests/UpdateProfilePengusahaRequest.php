<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePengusahaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nomor_identitas_user' => 'required|string|regex:/^[0-9]*$/|max:16|unique:profile_pengusaha,nomor_identitas_user,' . $this->profile_pengusaha->id,
            'nama_pengusaha' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'no_telp' => 'nullable|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,8}$/',
            'email' => 'nullable|email'
        ];
    }

    public function messages()
    {
        return [
            'nomor_identitas_user.required' => 'Nomor Identitas Pengusaha Wajib Diisi',
            'nomor_identitas_user.regex' => 'Nomor Identitas Pengusaha Tidak Boleh Karakter',
            'nomor_identitas_user.unique' => 'Nomor Identitas Pengusaha Telah Ada',
            'nomor_identitas_user.max' => 'Nomor Identitas Pengusaha Melebihi Dari 16 Karakter',
            'nama_pengusaha.required' => 'Nama Pengusaha Wajib Diisi',
            'nama_pengusaha.string' => 'Nama Pengusaha Wajib Huruf',
            'nama_pengusaha.regex' => 'Nama Pengusaha Tidak Boleh Karakter',
            'no_telp.regex' => 'Nomor Telpon Tidak Sesuai Ketentuan',
            'email.email' => 'Email Tidak Sesuai Ketentuan',
        ];
    }
}
