<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $primaryKey = 'variant_id';

    protected $fillable = [
        'product_id',
        'ram',
        'rom',
        'color',
        'material',
        'stock',
        'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'variant_id', 'variant_id');
    }

    public function getNameAttribute()
    {
        return "{$this->ram}/{$this->rom} - {$this->color}";
    }
}
