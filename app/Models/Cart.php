<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function getItemCountAttribute()
    {
        return $this->items->sum('quantity');
    }

    public static function getOrCreateCart($userId = null, $sessionId = null)
    {
        $query = self::query();
        
        if ($userId) {
            $query->where('user_id', $userId);
        }
        
        if ($sessionId) {
            $query->where('session_id', $sessionId);
        }
        
        $cart = $query->where('status', 'pending')->first();

        if (!$cart) {
            $cart = self::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'status' => 'pending'
            ]);
        }

        return $cart;
    }
} 