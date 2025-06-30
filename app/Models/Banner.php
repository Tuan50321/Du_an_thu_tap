<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners'; // nếu tên bảng không phải dạng số nhiều theo mặc định
    protected $primaryKey = 'banner_id';
    public $timestamps = false;

    protected $fillable = [
        'image_url',
        'link_url',
        'position',
        'is_active',
    ];

    // Accessor để lấy image_url từ image
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getImageUrlFullAttribute()
    {
        return $this->image_url ? asset('storage/' . $this->image_url) : null;
    }
}
