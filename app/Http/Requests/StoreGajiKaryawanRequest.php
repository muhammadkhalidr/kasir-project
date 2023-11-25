<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGajiKaryawanRequest extends FormRequest
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
            'txtjumlahkerja' => 'required',
            'txtpersen' => 'required|numeric',
            'txtgaji' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'txtnama.required'            => ':attribute Tidak Boleh Kosong',
            'txtjumlahkerja.required'            => ':attribute Tidak Boleh Kosong',
            'txtpersen.required'            => ':attribute Tidak Boleh Kosong',
            'txtgaji.required'            => ':attribute Tidak Boleh Kosong',
        ];
    }

    public function attributes(): array
    {
        return [
            'txtnama' => 'Nama',
            'txtjumlahkerja' => 'Jumlah Kerja',
            'txtpersen' => 'Persen Gaji',
            'txtgaji' => 'Gaji',

        ];
    }
}
