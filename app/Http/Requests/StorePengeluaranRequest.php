<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengeluaranRequest extends FormRequest
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
            'txtket' => 'required',
            'txtjumlah' => 'required|numeric',
            'txttotal' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'txtket.required'            => ':attribute Tidak Boleh Kosong',
            'txtjumlah.required'            => ':attribute Tidak Boleh Kosong',
            'txtjumlah.numeric'            => ':attribute Harus Angka',
            'txttotal.required'            => ':attribute Tidak Boleh Kosong',
            'txttotal.numeric'            => ':attribute Harus Angka',
        ];
    }

    public function attributes(): array
    {
        return [
            'txtket' => 'Keterangan',
            'txtjumlah' => 'Jumlah',
            'txttotal' => 'Jumlah',
        ];
    }
}
