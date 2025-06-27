<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'price',
        'discount_price',
        'description',
        'status',
        'created_by',
        'thumbnail'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    // Relationship với Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    // Relationship với Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    // Relationship với User (người tạo)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    // Accessor để lấy giá hiển thị (giá giảm nếu có, nếu không thì giá gốc)
    public function getDisplayPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    // Accessor để kiểm tra xem sản phẩm có đang giảm giá không
    public function getIsDiscountedAttribute()
    {
        return !is_null($this->discount_price) && $this->discount_price < $this->price;
    }

    // Method để xử lý upload ảnh thumbnail
    public function uploadThumbnail($file)
    {
        if ($file) {
            $path = $file->store('products/thumbnails', 'public');
            $this->thumbnail = $path;
            $this->save();
            return $path;
        }
        return null;
    }

    // Method để lấy đường dẫn ảnh thumbnail
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return asset('images/default-thumbnail.jpg'); // Ảnh mặc định nếu không có thumbnail
    }
} 