<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'namaProduk' => 'required|max:20',
            'beratProduk' => 'required',
            'warnaProduk' => 'required|max:20',
            'tanggalProduksi' => 'required',
            'hargaProduk' => 'required',
            'idKategori' => 'required',
        ];
    }
}