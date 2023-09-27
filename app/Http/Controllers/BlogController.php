<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Blog\BlogService;
use App\Models\Blog;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService) {
        $this->blogService = $blogService;
    }

    public function index() {

        $blogs = $this->blogService->getAll();

        return view('blogs.index',[
            'title' => 'Danh sách tin tức',
            'blogs' => $blogs
        ]);
    }



    public function detail($id ='', $slug ='') {
        $blog = $this->blogService->show($id);
        $blogs = $this->blogService->getAll();

        return view('blogs.content', [
            'title' => $blog->name,
            'blog' => $blog,
            'blogs'=> $blogs
        ]);

    }
}
