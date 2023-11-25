<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'notrx.*' => 'required',
            'namapemesan.*' => 'required',
            'namabarang.*' => 'required',
            'jumlah.*' => 'required',
            'harga.*' => 'required',
            'total.*' => 'required',
            'uangmuka.*' => 'required',
            'subtotal.*' => 'required',
        ];
    }
}
