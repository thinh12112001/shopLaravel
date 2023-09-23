<?php

namespace App\Http\Services\Revenue;

use App\Models\Revenue;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;


class RevenueService
{
    public function get() {
        $rawData = DB::table('carts')
        ->join('customers', 'carts.customer_id', '=', 'customers.id')
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->select('carts.product_id', 'carts.price', 'carts.qty', 'products.price_original' , 'customers.created_at',
            DB::raw('carts.qty * carts.price as total' ), DB::raw('carts.qty * products.price_original as total_original' ))
                ->where(DB::raw('DAY(customers.created_at)'), '06' )
                ->get();
        dd($rawData);
    }
}
