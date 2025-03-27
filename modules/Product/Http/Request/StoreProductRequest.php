<?php

namespace Modules\Product\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()

    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.string' => 'Tên sản phẩm phải là chuỗi ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 191 ký tự.',
            'brand_id.required' => 'Vui lòng chọn thương hiệu.',
            'brand_id.exists' => 'Thương hiệu không hợp lệ.',
            'price.integer' => 'Giá phải là số',
            'price.min' => 'Giá phải lớn hơn 0',
        ];
    }
}
