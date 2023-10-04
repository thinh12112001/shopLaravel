<?php

namespace App\Http\Services\Coupon;

use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CouponService
{
    public function get() {
        
        return Coupon::orderby('coupon_id')->paginate(20);
    }

    public function insert($request) {
        try {
            $data = $request->all();
            Coupon::create($data);
            Session::flash('success', 'Thêm mới thành Công');

        } catch (\Exeption $err) {
            \Log::error("An error occurred", ['exception' => $err]);
            Session::flash('error', 'Thêm mới thất bại');
            return false;
        }
        return true;
    }

    public function delete($request) {
        $coupon = Coupon::where('coupon_id', $request->input('id'))->first();

        if ($coupon) {
            $coupon->delete();
            return true;
        }
        return false;
    }

    public function update($request, $coupon) {
        try {
            $coupon->fill($request->input());
            $coupon->save();
            $request->session()->flash('success', 'Cập nhật thành công');

        } catch (\Error $err) {
            $request->session()->flash('error', 'Cập nhật thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;

    }
}
