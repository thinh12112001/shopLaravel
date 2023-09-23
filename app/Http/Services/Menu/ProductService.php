<?php

namespace App\Http\Services\Menu;

use App\Models\Product;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductService
{
    public function getParent() {
        return Menu::where('parent_id', 0)->get();
        //product::where...
    }

    public function getAll() {
        return Product::orderbyDesc('id')->paginate(20);
    }

    public function create($request) {
        try {
            Product::create([
                'name' => (string) $request->input('name'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'menu_id' => (int) $request->input('menu_id'),
                'price' => (int) $request->input('price'),
                'price_sale' => (int) $request->input('price_sale'),
                'active' => (string) $request->input('active'),
                'thumb' => (string) $request->input('thumb'),
            ]);
            $request->session()->flash('success', 'Tạo thành công');
        }
        catch (\Exception $err)
        {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function update($request, $product) {
        try {
            if ($request->input('parent_id') != $product->id) {
                $product->parent_id = (int) $request->input('parent_id');
            }
            $product->name = (string) $request->input('name');
            $product->description = (string) $request->input('description');
            $product->content = (string) $request->input('content');
            $product->active = (string) $request->input('active');
            $product->save();

            Session::flash('success', 'Cập nhật thành công danh mục');
            // $request->session()->flash('status', 'Task was successful!');
            return true;
        } catch (\Exception $ex) {
            Session::flash('error', 'Cập nhật thất bại');
            return false;
        }

    }

    public function destroy($request) {
        $id = (int) $request->input('id');

        $product = Product::where('id', $id)->first();

        if ($product) {
            return Product::where('id', $id )->orWhere('parent_id' , $id)->delete();
        }
        return false;
    }
}
