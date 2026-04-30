<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'qty'         => 'required|integer|min:0',
            'price'       => 'required|numeric',
            'user_id'     => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Nama produk wajib diisi.',
            'name.max'           => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'qty.required'       => 'Jumlah (kuantitas) produk wajib diisi.',
            'qty.integer'        => 'Jumlah produk harus berupa angka bulat.',
            'price.required'     => 'Harga produk wajib diisi.',
            'price.numeric'      => 'Harga produk harus berupa angka yang valid.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
        ];
    }
}