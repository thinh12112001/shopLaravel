<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\Product\CreateFormRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;
use App\Models\Product;

class ProductController extends Controller
{

    function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view( 'admin.product.list',[
            'title' => 'Danh sách sản phẩm mới nhất',
            'products' => $this->productService->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.add', [
            'title' => 'Thêm sản phẩm mới',
            'menus' => $this->productService->getMenu()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $result = $this->productService->insert($request);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Chỉnh sửa sản phẩm',
            'product'=> $product,
            'menus' => $this->productService->getMenu()
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $result = $this->productService->update($request, $product);

        if ($result) {
            return redirect('/admin/products/list');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }
        else {
            return response()->json([
                'error' => true
            ]);
        }
    }
}
