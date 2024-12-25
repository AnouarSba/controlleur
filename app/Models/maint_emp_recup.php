<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class maint_emp_recup extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        
        'date',
        'holiday_id',
        'event_id',
        'emp_status_id',
        'sign',
        'emp_id'
 
    ];
}