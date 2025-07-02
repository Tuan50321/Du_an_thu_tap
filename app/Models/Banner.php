<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners'; // tên bảng
    protected $primaryKey = 'banner_id';
    public $timestamps = false;

    protected $fillable = [
        'image_url',
        'link_url',
        'position',
        'is_active',
    ];

    public function getImageUrlAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
}
