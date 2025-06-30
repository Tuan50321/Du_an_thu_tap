<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $primaryKey = 'category_id';
    
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'status'
    ];

    // Relationship với danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'category_id');
    }

    // Relationship với các danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }

    // Relationship với products
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }

    // Tự động tạo slug khi set name
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
} 