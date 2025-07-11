<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'price'
    ];

    public $timestamps = false;

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
}