<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Otorisasi lebih lanjut ditangani di controller (authorize('update', $product))
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
            'name'    => 'required|string|max:255',
            'qty'     => 'required|integer|gt:0',
            'price'   => 'required|numeric|gt:0',
            'user_id' => 'nullable|exists:users,id',
        ];
    }

    /**
     * Get custom validation error messages in Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

            'qty.required' => 'Jumlah produk wajib diisi.',
            'qty.integer' => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'qty.gt' => 'Jumlah produk harus lebih dari 0.',

            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka yang valid.',
            'price.gt' => 'Harga produk harus lebih dari 0.',

            'user_id.exists'   => 'Pengguna yang dipilih tidak ditemukan dalam sistem.',
        ];
    }

    /**
     * Custom attribute labels for more friendly error messages.
     */
    public function attributes(): array
    {
        return [
            'name'    => 'Nama Produk',
            'qty'     => 'Kuantitas',
            'price'   => 'Harga',
            'user_id' => 'Pemilik Produk',
        ];
    }
}
