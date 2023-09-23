<?php

namespace App\Http\Services\Cart;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Cart;
use App\Jobs\SendMail;
use Illuminate\Support\Facades\DB;

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
            $carts = Session::get('carts');

            if (is_null($carts))
                return false;

            $customer = Customer::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'content' => $request->input('content')
            ]);

            #add to cart in db
            $this->infoProductCart($carts, $customer->id);
            DB::commit();


            #Queue
            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            #Remove session
            Session::forget('carts');

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

    // thêm data thông tin đặt hàng (CART) vào  DB
    protected function infoProductCart($carts, $customer_id) {

        $product_id = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale','file')
                        ->where('active',1)
                        ->whereIn('id', $product_id)
                        ->get();

        $data= [];



        foreach ($products as $product) {
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'qty' => $carts[$product->id],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price
            ];
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
}
