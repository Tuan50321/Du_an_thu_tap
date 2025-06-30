<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $primaryKey = 'brand_id';
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'logo'
    ];

    // Relationship với products
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }

    // Tự động tạo slug khi set name
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
} 