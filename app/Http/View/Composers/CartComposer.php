<?php

namespace App\Http\View\Composers;


use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartComposer
{

    protected $users;

    public function __construct() {

    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $carts = Session::get('carts');

        if (is_null($carts)) {
            return [];
        }

        $product_id = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale','file')
            ->where('active',1)
            ->whereIn('id', $product_id)
            ->get();

        $view->with('products',$products)
        ->with('carts', $carts);;
    }

    // public function compose(View $view)
    // {
    //     $carts = Session::get('carts');
    //    if(is_null($carts)) {
    //         $products =[];
    //     }
    //     else{
    //     $productId = array_keys($carts);
    //    $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
    //         ->where('active', 1)
    //         ->whereIn('id', $productId)
    //         ->get();

    // }
    //     $view->with('products',$products);

    // }
}
