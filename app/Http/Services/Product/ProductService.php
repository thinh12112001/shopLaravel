<?php

namespace App\Http\Services\Product;

use App\Models\Product;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    public function getParent() {
        return Menu::where('parent_id', 0)->get();
        //product::where...
    }

    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    public function isValidPrice($request) {
        if ($request->input('price') != 0 && $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price'))
        {
            $request->session()->flash('error', 'Giá sale phải nhỏ hơn giá bán');
            return false;
        }
        else if ($request->input('price_sale') != 0 && $request->input('price') == 0) {
            $request->session()->flash('error', 'Vui lòng nhập giá bán');
            return false;
        }

        else if ($request->input('price_sale') != 0 && $request->input('price_original') < $request->input('price_sale')) {
            $request->session()->flash('error', 'Giá sale phải lớn hơn giá gốc');
            return false;
        }

        else if ($request->input('price_original')  >= $request->input('price')) {
            $request->session()->flash('error', 'Giá bán phải lớn hơn giá gốc');
            return false;
        }

        return true;
    }

    public function insert($request) {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false){
            return false;
        }

        try {
            $request->except('_token');
            Product::create($request->all());

            $request->session()->flash('success', 'Thêm sản phẩm thành công');
        }
        catch (\Exception $err) {
            $request->session()->flash('error', 'Thêm sản phẩm thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function get() { 
        return Product::
            with('menu')
            ->orderby('id')->paginate(10);
    }

    public function update($request, $product) {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false){
            return false;
        }
        try {
            $product->fill($request->input());
            $product->save();
            $request->session()->flash('success', 'Cập nhật thành công');

        } catch (\Throwable $th) {
            $request->session()->flash('error', 'Cập nhật thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;


    }

    public function delete($request) {
        $product = Product::where('id', $request->input('id'))->first();



        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }
}
