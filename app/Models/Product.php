<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'price_original',
        'active',
        'file',
        'product_views',
        'product_quantity'
    ];

    public function menu() {
        return $this->hasone(Menu::class, 'id', 'menu_id')
            ->withDefault(['name','']);
    }

    public function comment() {
        return $this->hasMany('App\Models\Comment');
    }
}
