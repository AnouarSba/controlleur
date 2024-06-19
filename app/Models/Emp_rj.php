<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emp_rj extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'date',
        'emp_status_id',
        'sign',
        'emp_id'
 
    ];
}