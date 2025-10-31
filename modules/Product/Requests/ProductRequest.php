<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'price' => ['required', 'integer'],
            'state' => ['boolean'],
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
