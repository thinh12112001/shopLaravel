<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Http\Services\Coupon\CouponService;
use App\Http\Requests\Coupon\CouponRequest;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService) {
        $this->couponService = $couponService;
    }

    public function create() {

        return view(
            'admin.coupons.add',
            [
                'title' => 'Thêm mới mã giảm giá',
            ]
        );
    }

    public function store(CouponRequest $request) {
        $result = $this->couponService->insert($request);

        if ($result) {
            return redirect()->back();
        }

    }

    public function show(Coupon $coupon) {
        // dd($coupon->coupon_id);
        return view(
            'admin.coupons.edit',
            [
                'title' => 'Cập nhật mã giảm giá',
                'coupon' =>$coupon
            ]
        );
    }

    public function update(Request $request, Coupon $coupon) {
        $result = $this->couponService->update($request, $coupon);

        if ($result) {
            return redirect('/admin/coupons/list');
        }
        return redirect()->back();
    }

    public function index() {
        $coupons = $this->couponService->get();

        return view('admin.coupons.list', [
            'title' => 'Danh sách mã giảm giá',
            'coupons' => $coupons
        ]);
    }

    public function destroy(Request $request)
    {
        // dd($request->input('id'));
        $result = $this->couponService->delete($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công mã giảm giá'
            ]);
        }
        else {
            return response()->json([
                'error' => true
            ]);
        }
    }
}
