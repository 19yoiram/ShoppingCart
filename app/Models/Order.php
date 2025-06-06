<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id',
        'amount',
        'status',
    ];

    public function orderDetails()
{
    return $this->hasMany(OrderDetail::class);
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
