<?php

namespace App\Models\Canteen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }
}
