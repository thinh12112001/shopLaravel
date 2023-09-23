<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Comment\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService) {
        $this->commentService = $commentService;
    }

    public function index() {
        return view('admin.comment.list_comment', [
            'title' => 'Danh sách bình luận',
            'comments' =>  $this->commentService->getAllComment()
        ]);
    }
}
