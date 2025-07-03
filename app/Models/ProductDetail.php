<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'products'; // Vì dùng chung bảng products
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name', 'description', 'thumbnail', 'regular_price', 'sale_price',
        'brand_id', 'category_id', 'status'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
