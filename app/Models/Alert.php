<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
    protected $fillable = [
        'alert_type',
        'user_id',
        'bus_id',
        'lat',
        'lang',
        'ligne_id',
        'arret_id',
        'alert',
        'alert_date'
    ];
}