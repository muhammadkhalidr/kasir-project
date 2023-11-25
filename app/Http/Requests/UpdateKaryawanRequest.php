<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKaryawanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'txtnama' => 'required',
            'txtalamat' => 'required',
            'txtemail' => [
                'required',
                Rule::unique('karyawans', 'email')->ignore($this->txtid, 'id_karyawan'),
                'email'
            ],
            'txtphone' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'txtnama.required'      => ':attribute Tidak Boleh Kosong',
            'txtalamat.required'        => ':attribute Tidak Boleh Kosong',
            'txtemail.required'         => ':attribute Tidak Boleh Kosong',
            'txtemail.unique'           => ':attribute Sudah Terdaftar Gunakan Email Lain',
            'txtphone.required'         => ':attribute Tidak Boleh Kosong',
            'txtphone.numeric'          => ':attribute Silakan Gunakan Number',
        ];
    }

    public function attributes(): array
    {
        return [
            'txtnama' => 'Nama Lengkap',
            'txtalamat' => 'Alamat',
            'txtemail' => 'Email',
            'txtphone' => 'No Hp',
        ];
    }
}
