<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddWarehouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'price' => 'required|numeric',
            'quantity' => 'required|numeric|min:0',
            'supplier' => 'not_in:0',
            'size' => 'not_in:0',
            'products' => 'not_in:0',

        ];
    }
    public function messages()
    {
        return [
            'price.required' => 'Vui lòng nhập giá ',
            'price.numeric' => 'Vui lòng nhập giá trị số',
            'quantity.required' => 'Vui lòng nhập số lượng ',
            'quantity.numeric' => 'Vui lòng nhập giá trị số',
            'quantity.min' => 'Vui lòng nhập số lượng lớn hơn 0 ',
            'supplier.not_in' => 'Vui lòng chọn nhà cung cấp',
            'size.not_in' => 'Vui lòng chọn size',
            'products.not_in' => 'Vui lòng chọn sản phẩm',
        ];
    }
}
