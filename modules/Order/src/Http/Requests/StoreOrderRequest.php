<?php

namespace Modules\Order\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer.name'      => ['required', 'max:255'],
            'customer.email'     => ['required', 'email', 'max:255'],
            'customer.phone'     => ['required', 'max:255'],
            'customer.address'   => ['required'],
            'lines'              => ['required', 'array'],
            'lines.*.product_id' => ['required', 'exists:products,id'],
            'lines.*.quantity'   => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
