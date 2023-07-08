<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_name',
        'sender_address',
        'sender_phone_number',
        'receiver_name',
        'receiver_address',
        'receiver_phone_number',
        'weight',
        'description',
        'tracking_number',
        'status'
    ];
}
