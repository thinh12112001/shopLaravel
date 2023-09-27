<?php

namespace App\Http\Services\Blog;

use App\Models\Blog;

class BlogService
{
    public function getAll() {
        return Blog::where('active', 1)->get();
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
