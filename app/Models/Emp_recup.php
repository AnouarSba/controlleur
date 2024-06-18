<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emp_recup extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'date',
        'holiday_id',
        'event_id',
        'emp_status_id',
        'sign',
        'emp_id'
 
    ];
}