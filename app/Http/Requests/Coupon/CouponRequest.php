<?php

namespace App\Http\Requests\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'coupon_name' => 'required',
            'coupon_time' => 'required',
            'coupon_number' => 'required',
            'coupon_code' => 'required',
            'coupon_condition' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail("Vui lòng chọn tính năng mã");
                    }
                },
            ],
        ];
    }

    public function messages() : array {
        return [
            'coupon_name.required' => 'Vui lòng nhập tên mã giảm giá',
            'coupon_time.required' => 'Vui lòng nhập số số lượng mã giảm giá',
            'coupon_number.required' => 'Vui lòng nhập số tiền giảm',
            'coupon_code.required' => 'Vui lòng nhập mã giảm giá',
        ];
    }
}
