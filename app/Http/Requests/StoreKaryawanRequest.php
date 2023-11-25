<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKaryawanRequest extends FormRequest
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
            'txtid' => 'required|unique:karyawans,id_karyawan|min:7|max:7',
            'txtnama' => 'required',
            'txtalamat' => 'required',
            'txtphone' => 'required|numeric',
            'txtemail' => 'required|email|unique:karyawans,email',
            'txtfoto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'txtid.required'            => ':attribute Tidak Boleh Kosong',
            'txtid.unique'              => ':attribute ID Sudah Terdaftar',
            'txtnama.required'          => ':attribute Tidak Boleh Kosong',
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
            'txtid' => 'ID Karyawan',
            'txtnama' => 'Nama Lengkap',
            'txtalamat' => 'Alamat',
            'txtemail' => 'Email',
            'txtphone' => 'No Hp',
        ];
    }
}
