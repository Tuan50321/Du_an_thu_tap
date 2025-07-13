<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';
    protected $primaryKey = 'profile_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; // Bỏ qua timestamps

    protected $fillable = [
        'user_id',
        'phone',
        'province',
        'district',
        'ward',
        'street',
        'birthday',
        'gender'
    ];

    protected $casts = [
        'birthday' => 'date',
        'gender' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
