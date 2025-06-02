<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    public $timestamps = false;
    
    protected $primaryKey = 'brand_id';
    
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    // Tự động tạo slug khi set name
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
} 