<?php

namespace App\Http\Services\Product;

use App\Models\Product;

class ProductmainService
{
    const LIMIT = 4;

    public function get($page = null) {
        return Product::Select('id', 'name', 'price', 'price_sale', 'file')
            ->orderByDesc('id')
            ->when($page != null, function($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();

    }

    public function show($id) {
        return Product::where('id' ,$id)
                ->where('active', 1)
                ->with('menu')
                ->firstOrFail();
    }

    public function more($id) {
        return Product::Select('id', 'name', 'price', 'price_sale', 'file')
        ->where('active', 1)
        ->where('id', '!=' , $id)
        ->orderByDesc('id')
        ->limit(12)
        ->get();
    }

}
