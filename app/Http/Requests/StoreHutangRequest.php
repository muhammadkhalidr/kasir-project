<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHutangRequest extends FormRequest
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
            'nama' => 'required',
            'jumlah' => 'required',
            'total' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'            => ':attribute Tidak Boleh Kosong',
            'jumlah.required'            => ':attribute Tidak Boleh Kosong',
            'total.required'            => ':attribute Tidak Boleh Kosong',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama',
            'jumlah' => 'Jumlah',
            'total' => 'Total',

        ];
    }
}
