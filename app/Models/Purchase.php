<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'customer_name',
        'phone_number',
        'product_id',
        'quantity',
        'total_price',
    ];

    public function drug()
    {
        return $this->belongsTo(Drug::class, 'product_id');
    }
}
