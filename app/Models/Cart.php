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
        $cart = null;

        // Nếu có userId (đã đăng nhập), ưu tiên tìm theo user_id
        if ($userId) {
            $cart = self::where('user_id', $userId)
                ->where('status', 'pending')
                ->first();
        }

        // Nếu không có userId hoặc chưa tìm được cart theo user => tìm theo session_id
        if (!$cart && $sessionId) {
            $cart = self::where('session_id', $sessionId)
                ->where('status', 'pending')
                ->first();
        }

        // Nếu vẫn chưa có cart thì tạo mới
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
