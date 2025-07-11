<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order_Detail;

class Order extends Model 
{
    protected $fillable = [
        'user_id',
        'table_id',
        'status'
    ];

    public function orderDetails() 
    {
        return $this->hasMany(Order_Detail::class, 'order_id');
    }
}