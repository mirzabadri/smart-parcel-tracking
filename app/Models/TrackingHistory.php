<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingHistory extends Model
{
    use HasFactory;

    protected $table = 'tracking_history';

    protected $fillable = ['status'];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
}
