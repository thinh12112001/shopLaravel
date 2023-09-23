<?php

namespace App\Http\Services\Comment;

use App\Models\Comment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CommentService
{
    public function getAllComment() {
        return Comment::with('product')->orderBy('comment_status')->paginate(15);
    }
}
