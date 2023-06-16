<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infraction extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_type',
        'user_id',
        'emp_id',
        'bus_id',
        'lat',
        'lang',
        'ligne_id',
        'arret_id',
        'infra_id',
        'infra_date'
    ];
}
