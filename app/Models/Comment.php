<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'comment',
        'comment_name',
        'comment_date',
        'comment_product_id',
        'comment_comment_parent',
        'comment_status',

    ];

    protected $primaryKey ='comment_id';
    protected $table = 'comment';

    public function product() {
        return $this->belongsTo('App\Models\Product', 'comment_product_id');
    }
}
