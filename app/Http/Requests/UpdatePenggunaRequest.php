<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePenggunaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required',
            'username' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->nama, 'name'),
                'email'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'      => ':attribute Tidak Boleh Kosong',
            'username.required'        => ':attribute Tidak Boleh Kosong',
            'email.required'         => ':attribute Tidak Boleh Kosong',
            'email.unique'           => ':attribute Sudah Terdaftar Gunakan Email Lain',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama Lengkap',
            'username' => 'Alamat',
            'email' => 'Email',
        ];
    }
}
