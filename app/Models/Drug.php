<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'expiry_date',
        'prescription_required',
        'is_prescription'
    ];
}
