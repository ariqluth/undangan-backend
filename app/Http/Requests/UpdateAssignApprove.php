<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAssignApprove extends FormRequest
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
            'longtitude' => 'nullable|string|min:3',
            'latitude' => 'nullable|string|min:3',
            'gambar.*' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'longtitude.required' => 'longtitude Wajib Disi',
            'latitude.required' => 'latitude Wajib Disi',
            'gambar.*.image' => 'wajib format jpeg, png, jpg',
            'gambar.*.max' => 'ukuran file max 5 mb',
        ];
    }
}
