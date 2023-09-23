<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable =[
        'order_date',
        'sales',
        'profit',
        'quantity',
        'total_order'
    ];

    protected $primaryKey = 'id_statistical';
    protected $table = 'statistical';


}
