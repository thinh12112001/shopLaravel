<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Services\Cart\CartService;
use App\Models\Product;
use App\Models\Coupon;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
    }

    public function index(Request $request) {
        $result = $this->cartService->create($request);


        if($result === false) {

            return redirect()->back();
        }
        return redirect('/carts');
    }

    public function addcartmainpage(Request $request) {
        $result = $this->cartService->createinquickview($request);

        if($result === false) {
            return redirect()->back();
        }

        // return redirect()->route('show.popup', ['product_id' => $request->input('product_id')]);
        // return redirect()->back()->with('message','Operation Successful !');
    }

    public function showPopup(Request $request) {

        $product_id = $request->product_id;
        // dd($product_id);

        $product = Product::find($product_id);

        // dd($product);
        return view('popup_content', compact('product'));
    }

    public function show() {

        $products = $this->cartService->getProduct();

        return view('carts.list', [
            'title' => 'Giỏ hàng',
            'products'=>$products,
            'carts' => Session::get('carts')
        ]);
    }

    public function update(Request $request) {
        $this->cartService->update($request);

        return redirect('/carts')->withInput();
    }

    public function remove($id = 0) {

        $this->cartService->remove($id);

        return redirect('/carts');
    }

    public function addCart(Request $request) {
        $result = $this->cartService->addCart($request);

        if ($result) {
            return redirect()->back();
        }

        return redirect('/carts');

    }

    public function paypal(Request $request) {

        // dd(round($request->input('total') * 24144));

        $result = $this->cartService->paypal($request);

        if ($result) {
            return redirect()->back();
        }

        return redirect('/carts');
    }

    public function check_coupon(Request $request) {
        try {
            $data = $request->all();
            $coupon  = Coupon::where("coupon_code", $data['coupon'])->first();
            $result = $this->cartService->checkcoupon($coupon, $request);
            return redirect()->back()->withInput();

        } catch (\Exception $err) {
            \Log::error("An error occurred", ['exception' => $err]);
        }
    }

    public function remove_coupon(Request $request) {
        $coupon = Session::get('coupon');

        $result = $this->cartService->removeCoupon($coupon, $request);

        return redirect('/carts')->withInput();
    }
}
