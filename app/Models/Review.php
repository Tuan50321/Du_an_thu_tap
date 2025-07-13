<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews'; // nếu tên bảng không đúng chuẩn Laravel

    protected $primaryKey = 'review_id'; // nếu khoá chính không phải 'id'

    public $timestamps = true;
    // nếu có cột created_at, updated_at

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'content',
        'is_approved',
        'created_at',
        'updated_at'
    ];

    // Quan hệ: mỗi review thuộc về 1 người dùng
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    // Quan hệ: mỗi review thuộc về 1 sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function getRouteKeyName()
    {
        return 'review_id';
    }
}