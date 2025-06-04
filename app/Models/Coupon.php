<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $primaryKey = 'coupon_id';

    protected $fillable = [
        'code', 'discount_type', 'value', 'max_discount_amount',
        'min_order_value', 'max_order_value', 'max_usage_per_user',
        'start_date', 'end_date', 'status'
    ];
}