<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Table extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'order_id',
        'status'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsToMany(Users::class);
    }
}