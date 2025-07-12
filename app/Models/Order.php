<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id'; // ✅ rất quan trọng!

    protected $fillable = [
        'user_id',
        'status',
        'payment_method',
        'total_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'processing' => 'Đang chuẩn bị hàng',
            'shipping' => 'Đang giao',
            'delivered' => 'Đã giao',
            'completed' => 'Đã hoàn tất',
            'cancelled' => 'Đã hủy',
            'refunded' => 'Đã hoàn tiền',
            default => 'Không xác định',
        };
    }

    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            'pending' => 'warning',
            'confirmed', 'processing' => 'info',
            'shipping' => 'primary',
            'delivered' => 'success',
            'completed' => 'success',
            'cancelled', 'refunded' => 'danger',
            default => 'secondary',
        };
    }
}
