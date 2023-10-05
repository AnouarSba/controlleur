<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bus_id',
        'ligne_id',
        'kabid_id',
        'chauffeur_id',
        'place',
        'num',
 
    ];
}