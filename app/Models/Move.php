<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bus_id',
        'station_id',
        'kabid_id',
        'chauffeur_id',
        'service',
        'timing',
        'status',
        'gstatus',

    ];
}