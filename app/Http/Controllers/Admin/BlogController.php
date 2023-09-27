<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Blog\BlogService;
use App\Models\Blog;
use App\Http\Requests\Blog\BlogRequest;

class BlogController extends Controller
{
    protected $blogService;

    function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index() {
        return view('admin.blogs.list',[
            'title' => 'Danh sách tin tức mới nhất',
            'blogs' => $this->blogService->getAll(),
        ]);
    }

    public function show(Blog $blog)
    {
        return view('admin.blogs.edit', [
            'title' => 'Chỉnh sửa tin tức',
            'blog'=> $blog
        ]);
    }

    public function create() {
        return view('admin.blogs.add', [
            'title' => 'Thêm tin tức mới'
        ]);
    }

    public function store(BlogRequest $request) {
        $result = $this->blogService->insert($request);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $result = $this->blogService->update($request, $blog);

        if ($result) {
            return redirect('/admin/blog/list');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->blogService->delete($request);

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
