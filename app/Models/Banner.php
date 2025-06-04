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
}
