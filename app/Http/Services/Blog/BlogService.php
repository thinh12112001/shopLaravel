<?php

namespace App\Http\Services\Blog;

use App\Models\Blog;

class BlogService
{
    public function get($request) {
        $query = Blog::where('active',1);
        
        if ($request->input('search')) {
            $query->where('name', 'like','%'. $request->input('search'). '%');

        }

        #orderBy top views
        if ($request->input('orderBy'))  {
            if ( $request->input('orderBy') == 'views') {
                $query->orderBy('blog_views', $request->input('type'));
            } else {
                $query->orderBy('created_at', $request->input('type'));
            }
        }


        return $query->paginate(12)->withQueryString();
    }

    public function getAll() {
        return Blog::orderby('id')->paginate(20);
    }

    public function insert($request) {

        try {
            $request->except('_token');
            Blog::create($request->all());

            $request->session()->flash('success', 'Thêm sản phẩm thành công');
        }
        catch (\Exception $err) {
            $request->session()->flash('error', 'Thêm sản phẩm thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function show($id) {
        return Blog::where('id' ,$id)
        ->where('active', 1)
        ->firstOrFail();
    }

    public function update($request, $blog) {
        try {
            $blog->fill($request->input());
            $blog->save();
            $request->session()->flash('success', 'Cập nhật thành công');

        } catch (\Throwable $th) {
            $request->session()->flash('error', 'Cập nhật thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request) {
        $blog = Blog::where('id', $request->input('id'))->first();

        if ($blog) {
            $blog->delete();
            return true;
        }
        return false;
    }
}
