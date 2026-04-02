<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pelanggan_id' => 'nullable|exists:pelanggan,id',
            'tanggal_penjualan' => 'required|date',
            'produk' => 'required|array|min:1',
            'produk.*.produk_id' => 'required|exists:produk,id',
            'produk.*.jumlah' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_penjualan.required' => 'Tanggal penjualan wajib diisi.',
            'tanggal_penjualan.date' => 'Format tanggal tidak valid.',
            'produk.required' => 'Minimal satu produk harus dipilih.',
            'produk.array' => 'Format produk tidak valid.',
            'produk.min' => 'Minimal satu produk harus dipilih.',
            'produk.*.produk_id.required' => 'Produk wajib dipilih.',
            'produk.*.produk_id.exists' => 'Produk tidak ditemukan.',
            'produk.*.jumlah.required' => 'Jumlah produk wajib diisi.',
            'produk.*.jumlah.integer' => 'Jumlah harus berupa angka.',
            'produk.*.jumlah.min' => 'Jumlah minimal 1.',
        ];
    }
}