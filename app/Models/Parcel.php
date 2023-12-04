<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parcel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parcels';

    protected $fillable = [
        'user_id',
        'tracking_id',
        'price',
        'quantity',
        'online_address',
        'description',
    ];
}
