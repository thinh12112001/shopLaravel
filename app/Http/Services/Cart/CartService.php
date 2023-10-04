<?php

namespace App\Http\Services\Cart;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\Coupon;
use App\Jobs\SendMail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CartService
{
    public function create($request) {

        $qty = (int) $request->input('num_product');
        $product_id = (int)$request->input('product_id');


        if ($qty <= 0 || $product_id <= 0) {
            $request->session()->flash('error', 'Số lượng sản phẩm không chính xác');
            return false;
        }


        $carts = Session::get('carts');



        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);

        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts', $carts);

        return true;
    }

    public function createinquickview($request) {

        $qty = (int) $request->input('num_product');
        $product_id = (int)$request->input('product_id');
        if ($qty <= 0 || $product_id <= 0) {
            $request->session()->flash('error', 'Số lượng sản phẩm không chính xác');
            return false;
        }


        $carts = Session::get('carts');



        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);

        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts', $carts);

        return true;
    }

    public function getProduct() {
        $carts = Session::get('carts');

        if (is_null($carts)) {
            return [];
        }

        $product_id = array_keys($carts);
        return Product::select('id', 'name', 'price', 'price_sale','file')
            ->where('active',1)
            ->whereIn('id', $product_id)
            ->get();
    }

    public function update($request) {
        Session::put('carts', $request->input('num_product'));

        return true;
    }

    public function remove($id) {
        $carts = Session::get('carts');
        unset($carts[$id]);
        Session::put('carts', $carts);

        if (empty($carts)) {
            Session::forget('coupon');
        }
        return true;
    }

    public function destroycartadmin($cus_id) {
        $result = Cart::where('customer_id', $cus_id)->delete();
        if ($result) {
            return true;
        }
        return false;
    }

    public function paypal($request) {
        try {
            DB::beginTransaction();
            $carts = Session::get('carts');

            if (is_null($carts))
                return false;

            $customer = Customer::create([
                'name' => 'paypal_cus',
                'phone' =>  'paypal_cus',
                'address' =>  'paypal_cus',
                'email' =>  'paypal_cus',
                'content' =>  'paypal_cus'
            ]);

            #add to cart in db
            $this->infoProductCart($carts, $customer->id);
            DB::commit();


            #Queue
            // SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            #Remove session
            Session::forget('carts');
            Session::forget('coupon');

            #Statistic Revenue
            $rawData = DB::table('carts')
                ->join('customers', 'carts.customer_id', '=', 'customers.id')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->select('carts.product_id', 'carts.price', 'carts.qty', 'products.price_original' ,
                    DB::raw('DATE(customers.created_at) as created_date'),
                    DB::raw('carts.qty * carts.price as total' ),
                    DB::raw('carts.qty * products.price_original as total_original' ))
                        ->where('carts.customer_id',  $customer->id )
                        ->get();
            $revenue = [];
            foreach($rawData as $item) {
                $revenue[] =[
                    'order_date' => $item->created_date,
                    'sales' =>  $item->total,
                    'profit' => $item->total  - $item->total_original,
                    'quantity' => $item->qty,
                    'total_order' => 1
                ];

                $existingRecord = DB::table('statistical')->where('order_date', $item->created_date)->first();
                if ($existingRecord) {
                    $newProfit = $existingRecord->profit + ($item->total - $item->total_original);
                    $newSales = $existingRecord->sales + $item->total;
                    $newQuantity = $existingRecord->quantity + $item->qty;
                    $newTotalOrder = $existingRecord->total_order + 1;

                    $res = DB::table('statistical')
                        ->where('order_date', $item->created_date)
                        ->update(['profit' => $newProfit,
                                    'sales' => $newSales,
                                    'quantity' => $newQuantity,
                                    'total_order' => $newTotalOrder
                    ]);
                } else {
                    DB::table('statistical')->insert($revenue);
                }
                Session::flash('success', 'Đặt Hàng Thành Công');
            }


        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
            return false;
        }

        return true;
    }
    public function addCart($request)
    {
        try {
            DB::beginTransaction();
            $today = Carbon::now('Asia/Ho_Chi_minh')->format('Y-m-d');
            $carts = Session::get('carts');
            $coupon = Session::get('coupon');
            $salePrice = 0;
            $saleCondition = 0;

            $customer = Customer::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'content' => $request->input('content')
            ]);

            if ($coupon) {
                #update ID that use this coupon
                try {
                    $updateCouponTimeLeft = Coupon::where('coupon_id', $coupon[0]['coupon_id'])
                                                    ->whereNotIn('coupon_id', $coupon[0]['coupon_used'])
                                                    ->get();
                } catch (\Exception $err) {
                    DB::rollBack();
                    \Log::error("An error occurred: " . $err->getMessage());
                    Session::flash('error', 'Bạn đã dùng mã khuyến mãi này rồi');
                    return false;
                }

                $updateCouponTimeLeft = Coupon::findOrFail($coupon[0]['coupon_id']);

                if ($updateCouponTimeLeft->coupon_time == 0) {
                    DB::rollBack();
                    Session::flash('error', 'Mã khuyến mãi này đã hết, vui lòng dùng mã khác');
                    return false;
                } else if ($updateCouponTimeLeft->coupon_date_end < $today) {
                    DB::rollBack();
                    Session::flash('error', 'Mã khuyến mãi này đã hết hạn, vui lòng dùng mã khác');
                    return false;
                }
                $updateCouponTimeLeft->coupon_time = $updateCouponTimeLeft->coupon_time  -1;
                $updateCouponTimeLeft->coupon_used = $updateCouponTimeLeft->coupon_used. ','.  explode('@',$customer->email)[0];

                $updateCouponTimeLeft->save();

                $salePrice = $coupon[0]['coupon_number'];
                $saleCondition = $coupon[0]['coupon_condition'];

            }
            if (is_null($carts))
                return false;

            #add to cart in db
            $this->infoProductCart($carts, $customer->id, $salePrice, $saleCondition);
            DB::commit();

            #Queue
            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(5));

            #Remove session
            Session::forget('carts');
            Session::forget('coupon');

            #Statistic Revenue
            $rawData = DB::table('carts')
                ->join('customers', 'carts.customer_id', '=', 'customers.id')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->select('carts.product_id', 'carts.price', 'carts.qty', 'products.price_original' ,
                    DB::raw('DATE(customers.created_at) as created_date'),
                    DB::raw('carts.qty * carts.price as total' ),
                    DB::raw('carts.qty * products.price_original as total_original' ))
                        ->where('carts.customer_id',  $customer->id )
                        ->get();
            $revenue = [];
            foreach($rawData as $item) {
                $revenue[] =[
                    'order_date' => $item->created_date,
                    'sales' =>  $item->total,
                    'profit' => $item->total  - $item->total_original,
                    'quantity' => $item->qty,
                    'total_order' => 1
                ];

                $existingRecord = DB::table('statistical')->where('order_date', $item->created_date)->first();
                if ($existingRecord) {
                    $newProfit = $existingRecord->profit + ($item->total - $item->total_original);
                    $newSales = $existingRecord->sales + $item->total;
                    $newQuantity = $existingRecord->quantity + $item->qty;
                    $newTotalOrder = $existingRecord->total_order + 1;

                    $res = DB::table('statistical')
                        ->where('order_date', $item->created_date)
                        ->update(['profit' => $newProfit,
                                    'sales' => $newSales,
                                    'quantity' => $newQuantity,
                                    'total_order' => $newTotalOrder
                    ]);
                } else {
                    DB::table('statistical')->insert($revenue);
                }
                Session::flash('success', 'Đặt Hàng Thành Công');
            }


        } catch (\Exception $err) {
            DB::rollBack();
            \Log::error("An error occurred: " . $err->getMessage());
            Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
            return false;
        }

        return true;
    }

    // thêm data thông tin đặt hàng (CART) vào  DB
    protected function infoProductCart($carts, $customer_id, $salePrice =0, $saleCondition =0) {

        $product_id = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale','file')
                        ->where('active',1)
                        ->whereIn('id', $product_id)
                        ->get();

        $data= [];


        if ($saleCondition == 1) {
            foreach ($products as $key => $product) {
                $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                $priceAfterCoupon = $price  - ($price * $salePrice) /100;
                $data[] = [
                    'customer_id' => $customer_id,
                    'product_id' => $product->id,
                    'qty' => $carts[$product->id],
                    'price' =>  $priceAfterCoupon
                ];
            }
        } else if ($saleCondition == 0) {
            foreach ($products as $key => $product) {

                $data[] = [
                    'customer_id' => $customer_id,
                    'product_id' => $product->id,
                    'qty' => $carts[$product->id],
                    'price' =>  $product->price_sale != 0 ? $product->price_sale : $product->price
                ];
            }
        }

        return Cart::insert($data);
    }

    public function getCustomer() {
        return Customer::orderByDesc('id')->paginate(15);
    }

    public function getProductForCart($customer) {

        return $customer->carts()->with(['product' => function($query) {
            $query->select('id', 'name', 'file');
        }])->get();
    }

    public function checkcoupon($coupon, $request) {

        if ($coupon) {
            $count_coupon = $coupon->count();

            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');

                if ($coupon_session==true) {
                    $is_available = 0;
                    if ($is_available == 0) {
                        $count[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                            'coupon_time' => $coupon->coupon_time,
                            'coupon_id' => $coupon->coupon_id
                        );
                        Session::put('coupon', $count);
                    }
                } else {
                    $count[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                        'coupon_id' => $coupon->coupon_id
                    );
                    Session::put('coupon', $count);
                }

                Session::save();
                $request->session()->flash('success', 'Dùng mã thành công');
                return true;
            }
       }
       $request->session()->flash('error', 'Mã giảm giá không đúng hoặc đã hết hạn!');
       return false;
    }

    public function removeCoupon($coupon, $request) {
        try {
            if ($coupon) {
                Session::forget('coupon');
            }
            Session::flash('success', 'Gỡ mã giảm giá thành công');
        } catch (\Exception $err) {
            \Log::error("An error occurred: " . $err->getMessage());
            Session::flash('error', 'Gỡ mã thất bại! Vui lòng thử lại sau');
            return false;
        }
        return true;

    }
}
