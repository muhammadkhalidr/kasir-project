<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePembelianRequest extends FormRequest
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
            'txtid' => 'required',
            'txtbahan' => 'required',
            'txtjenis' => 'required',
            'txtsatuan' => 'required',
            'txtjumlah' => 'required|numeric',
            'txttotal' => 'required|numeric',
            'txtdp' => 'required|numeric',
            'txtsisa' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'txtid.required'            => ':attribute Tidak Boleh Kosong',
            'txtbahan.required'            => ':attribute Tidak Boleh Kosong',
            'txtjenis.required'            => ':attribute Tidak Boleh Kosong',
            'txtsatuan.required'            => ':attribute Tidak Boleh Kosong',
            'txtjumlah.required'            => ':attribute Tidak Boleh Kosong',
            'txtjumlah.numeric'            => ':attribute Harus Angka',
            'txttotal.required'            => ':attribute Tidak Boleh Kosong',
            'txttotal.numeric'            => ':attribute Harus Angka',
            'txtdp.required'            => ':attribute Tidak Boleh Kosong',
            'txtdp.numeric'            => ':attribute Harus Angka',
            'txtsisa.required'            => ':attribute Tidak Boleh Kosong',
            'txtsisa.numeric'            => ':attribute Harus Angka',
        ];
    }

    public function attributes(): array
    {
        return [
            'txtid' => 'No Faktur',
            'txtbahan' => 'Bahan',
            'txtjenis' => 'Jenis',
            'txtsatuan' => 'Satuan',
            'txtjumlah' => 'Jumlah',
            'txttotal' => 'Total',
            'txtdp' => 'Uang Muka',
            'txtsisa' => 'Sisa Pembayaran',
        ];
    }
}
