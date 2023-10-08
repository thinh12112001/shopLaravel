<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MenuService
{
    public function getParent() {
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll() {
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function show() {
        return Menu::select('id', 'name')->where('parent_id', 0)->orderbyDesc('id')->get();
    }

    public function create($request) {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active')
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

    public function update($request, $menu) {
        try {
            if ($request->input('parent_id') != $menu->id) {
                $menu->parent_id = (int) $request->input('parent_id');
            }
            $menu->name = (string) $request->input('name');
            $menu->description = (string) $request->input('description');
            $menu->content = (string) $request->input('content');
            $menu->active = (string) $request->input('active');
            $menu->save();

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

        $menu = Menu::where('id', $id)->first();

        if ($menu) {
            return Menu::where('id', $id )->orWhere('parent_id' , $id)->delete();
        }
        return false;
    }

    public function getId($id) {
        return Menu::where('id', $id)->where('active',1)->firstOrFail();
    }

    public function getProduct($menu, $request){
        // #order by rating
        // if ($request->has('rating')) {
        //     $ratingOrder = $request->input('rating') === 'asc' ? 'ASC' : 'DESC';

        //     $ratingQuery = $menu->products()
        //         ->select('products.id', 'products.name', 'products.price', 'products.price_sale', 'products.file', DB::raw('AVG(rating.rating) as avg_rating'))
        //         ->leftJoin('rating', 'products.id', '=', 'rating.product_id')
        //         ->groupBy('products.id','products.id', 'products.name', 'products.price', 'products.price_sale', 'products.file')
        //         ->havingRaw('AVG(rating.rating) >= 0')  // Chỉ lấy sản phẩm có đánh giá
        //         ->whereExists(function ($query) {
        //             $query->select(DB::raw(1))
        //                 ->from('rating')
        //                 ->whereRaw('rating.product_id = products.id');
        //         });

        //     // Sắp xếp theo giá trị trung bình đánh giá
        //     $ratingQuery->orderBy('avg_rating', $ratingOrder);

        //     return $ratingQuery->paginate(12)->withQueryString();
        // }

            #Region another sort and filter
            $query = $menu->products()
                ->select('products.id', 'products.name', 'products.price', 'products.price_sale', 'products.file')
                ->where('products.active', 1);

            if ($request->input('search')) {
                $query->where('name', 'like','%'. $request->input('search'). '%');

            }
            # filter price range
            if ($request->has('from') && is_numeric($request->input('from'))) {
                $query->whereBetween('price', [(int)$request->input('from'), (int)$request->input('to')]);
            }

            # orderby price
            if ($request->input('price')) {
                $query->orderBy('price', $request->input('price'));
            } elseif ($request->has('rating')) {
                $query->leftJoin('rating', 'products.id', '=', 'rating.product_id')
                    ->groupBy('products.id', 'products.name', 'products.price', 'products.price_sale', 'products.file')
                    ->havingRaw('AVG(rating.rating) >= 0')
                    ->whereExists(function ($subquery) {
                        $subquery->select(DB::raw(1))
                            ->from('rating')
                            ->whereRaw('rating.product_id = products.id');
                    });

                $ratingOrder = $request->input('rating') === 'asc' ? 'ASC' : 'DESC';
                $query->orderBy(DB::raw('AVG(rating.rating)'), $ratingOrder);
            }

            return $query->orderByDesc('id')
                ->paginate(12)->withQueryString();


    }
}
