<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderWithScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'client_id',
        'items',
        'status',
        'scores',
    ];
}
