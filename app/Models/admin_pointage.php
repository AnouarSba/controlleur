<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_pointage extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'emp_id',
        'emp_status_id',
        'date',
 
    ];
}
