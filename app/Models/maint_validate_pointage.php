<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maint_validate_pointage extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'date',
        'validation',
 
    ];
}
