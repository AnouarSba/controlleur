<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Kabid extends Model 
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'email',
        'phone',
        'password',
    ];
    protected $hidden = [
        'password',
        'authtoken',
    ];
}
