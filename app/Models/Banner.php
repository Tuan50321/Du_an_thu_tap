<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    protected $primaryKey = 'banner_id';
    public $timestamps = false;

    protected $fillable = [
        'image_url',
        'link_url',
        'position',
        'is_active',
    ];

    // ✅ Thêm accessor này
    public function getImageUrlFullAttribute()
    {
        return $this->image_url ? asset('storage/' . $this->image_url) : null;
    }
}
