<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'role_id',
        'city',
        'address',
        'phone',
        'password',
        'username',
        'code',
    ];

    public function role() 
    {
        return $this->belongsTo(Role::class);
    }

    public function tables()
    {
        return $this->belongsToMany(Table::class);
    }
}