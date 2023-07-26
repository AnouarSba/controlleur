<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coffre extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'emp_id',
        'lat',
        'lang',
        'ligne_id',
        't20',
        't25',
        't30',
        'money',
        'caisse',
        'ts',
        'rq',
        'time',
        'c_date'
    ];
}