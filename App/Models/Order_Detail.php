<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class Order_Detail extends Model 
{

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    public $timestamps = false;


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function order() 
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}